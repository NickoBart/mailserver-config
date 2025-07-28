<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertMail;

class CheckMailMetrics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:check-metrics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica métricas de correo y envía alertas si superan umbrales';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $t = config('stats');

        // Bounce rate
        $raw = shell_exec(<<<'SH'
for D in $(seq 6 -1 0); do
  FECHA=$(date -d "-$D days" '+%b %e')
  E=$(grep "$FECHA" /var/log/mail.log | grep status=sent  | wc -l)
  B=$(grep "$FECHA" /var/log/mail.log | grep -E "status=bounced|status=deferred" | wc -l)
  echo "$FECHA,$E,$B"
done
SH
        );
        $trend = collect(explode("\n", trim($raw)))
            ->map(fn($l) => array_combine(
                ['day','sent','bounce'], explode(',',$l)
            ));

        $totalSent   = $trend->sum('sent');
        $totalBounce = $trend->sum('bounce');
        $bounceRate  = $totalSent
            ? round($totalBounce / $totalSent * 100, 1)
            : 0;

        // Disk usage
        $diskUsage = intval(str_replace('%', '',
            trim(shell_exec("df -h --output=pcent / | tail -1"))
        ));

        // DMARC & DKIM (provisional)
        $dmarcRate = 72;
        $dkimRate  = 50;

        $alerts = [];
        if ($bounceRate > $t['bounce']) $alerts[] = "Bounce alto: {$bounceRate}%";
        if ($diskUsage  > $t['disk'])   $alerts[] = "Disco crítico: {$diskUsage}%";
        if ($dmarcRate  < $t['dmarc'])  $alerts[] = "DMARC bajo: {$dmarcRate}%";
        if ($dkimRate   < $t['dkim'])   $alerts[] = "DKIM bajo: {$dkimRate}%";

        if (count($alerts)) {
            Mail::to('soporte@connectia.info')
                ->send(new AlertMail($alerts));
            $this->info('Alertas enviadas: '.implode('; ',$alerts));
        } else {
            $this->info('Todas las métricas dentro de umbrales.');
        }
    }
}
