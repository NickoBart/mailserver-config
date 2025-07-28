<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuotaWarning;

class CheckMailboxQuotas implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        // 1) Traer todos los buzones
        $mailboxes = DB::connection('postfix')->table('mailbox')->get();

        foreach ($mailboxes as $mb) {
            // 2) Ejecutar doveadm para obtener la cuota actual
            $output = [];
            // ojo al mail_plugins=quota si lo necesitas
            exec("doveadm -o mail_plugins=quota quota get -u {$mb->username} 2>&1", $output);
            $text = implode("\n", $output);

            // 3) Extraer usados y totales (bytes)
            if (preg_match('/storage\s+(\d+)\s+\/\s+(\d+)/i', $text, $m)) {
                $used  = intval($m[1]);
                $total = intval($m[2]);
                $percent = $total > 0 ? ($used / $total) * 100 : 0;

                // 4) Si supera el umbral, enviar alerta
                if ($percent >= 80) {
                    Mail::to($mb->username)
                        ->queue(new QuotaWarning($mb->username, round($percent, 1)));
                }
            }
        }
    }
}
