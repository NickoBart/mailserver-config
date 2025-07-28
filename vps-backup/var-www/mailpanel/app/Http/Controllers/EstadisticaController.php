<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientLogin;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstadisticaController extends Controller
{
    public function index()
    {
        $user   = Auth::user();
        $client = $user->client;

        // ¿Es super-admin? (si no tiene cliente asociado)
        $isAdmin = is_null($client);

        // IDs de los dominios de este cliente (o colección vacía)
        $domIds = $client
            ? $client->domains()->pluck('id')
            : collect();

        // 1. Buzones activos y dominios validados (cliente)
        $buzonesActivos = ClientLogin::whereIn('client_domain_id', $domIds)->count();
        $dominiosVal    = $client
            ? $client->domains()->where('verified', 1)->count()
            : 0;

        // 2. Placeholder tasa de entrega
        $tasaEntrega = '–';

        // 3. Espacio en disco (global o promedio por dominio de cliente)
        if ($isAdmin) {
            // super-admin: uso de /
            $diskUsage = intval(str_replace('%','',
                trim(shell_exec("df -h --output=pcent / | tail -1"))
            ));
        } else {
            // cliente: promedio de /var/vmail/<dominio>
            $doms = $client->domains()->pluck('domain')->all();
            $sum  = 0;
            $cnt  = 0;
            foreach ($doms as $d) {
                $raw = trim(shell_exec(
                    "df -h --output=pcent /var/vmail/{$d} 2>/dev/null | tail -1"
                ));
                if (preg_match('/(\d+)%/',$raw,$m)) {
                    $sum += (int)$m[1];
                    $cnt++;
                }
            }
            $diskUsage = $cnt ? round($sum/$cnt,1) : 0;
        }

        // 4. Conteo dominios y buzones (global o solo de este cliente)
        if ($isAdmin) {
            // super-admin
            $domainsCount   = DB::table('postfixadmin.domain')
                                 ->where('domain','<>','ALL')
                                 ->count();
            $mailboxesCount = DB::table('postfixadmin.mailbox')->count();
        } else {
            // cliente
            $domainsCount   = $client->domains()->count();
            $mailboxesCount = DB::table('postfixadmin.mailbox')
                                 ->whereIn('domain', $client->domains()->pluck('domain'))
                                 ->count();
        }

        // filtro de logs si es cliente
        $grepFilter = $isAdmin
            ? ''
            : 'grep -E "from=.+@('
                . implode('|', $client->domains()->pluck('domain')->all())
                . ')|to=.+@('
                . implode('|', $client->domains()->pluck('domain')->all())
                . ')" | ';

        // 5. Tendencia envío vs rebote (7 días, con filtro por dominio si es cliente)
        $raw = shell_exec(<<<'SH'
for D in $(seq 6 -1 0); do
  FECHA=$(date -d "-$D days" '+%b %e')
  E=$(grep "$FECHA" /var/log/mail.log | $grepFilter grep status=sent    | wc -l)
  B=$(grep "$FECHA" /var/log/mail.log | $grepFilter grep -E "status=bounced|status=deferred" | wc -l)
  echo "$FECHA,$E,$B"
done
SH
        );
        $trend = collect(explode("\n", trim($raw)))->map(function($l){
            list($day, $sent, $bounce) = explode(',', $l);
            return [
              'day'    => $day,
              'sent'   => (int)$sent,
              'bounce' => (int)$bounce
            ];
        });

        // 6. Bounce rate
        $totalSent   = $trend->sum('sent');
        $totalBounce = $trend->sum('bounce');
        $bounceRate  = $totalSent
            ? round($totalBounce / $totalSent * 100, 1)
            : 0;

        // 7. DMARC / DKIM pass-rate (provisional)
        $dmarcRate = 72;
        $dkimRate  = 50;

        // 8. Tamaño medio de mensaje
        $rawAvg = trim(shell_exec(<<<'SH'
grep "$(date +'%b %e')" /var/log/mail.log \
  | grep -Eo "size=[0-9]+" \
  | awk -F'size=' '{sum+=$2; c++} END {print sum/c}'
SH
        ));
        $avgSize = is_numeric($rawAvg) ? (float)$rawAvg : 0;

        // 9. Top 5 destinatarios de hoy
        $rawTo = shell_exec(<<<'SH'
grep "$(date +'%b %e')" /var/log/mail.log \
  | grep -Eo "to=<[^>]+>" \
  | sed 's/to=//' \
  | sort | uniq -c | sort -nr | head -5
SH
        );
        $topRecipients = collect(explode("\n", trim($rawTo)))->map(function($line){
            if (! trim($line)) return;
            preg_match('/\s*(\d+)\s+<(.+)>/', $line, $m);
            return ['email'=>$m[2],'count'=>intval($m[1])];
        })->filter()->values();

        // 10. Últimos 5 registros (suscripciones, dominios, buzones)
        $ultimasSubs = Subscription::where('email', $user->email)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $ultimosDom = $client
            ? $client->domains()->orderBy('created_at','desc')->limit(5)->get()
            : collect();

        $ultimosBuz = ClientLogin::whereIn('client_domain_id', $domIds)
            ->orderBy('created_at','desc')->limit(5)->get();

        return view('vendor.adminlte.pages.estadisticas.index', compact(
            'buzonesActivos','dominiosVal','tasaEntrega',
            'diskUsage','domainsCount','mailboxesCount',
            'trend','bounceRate','dmarcRate','dkimRate',
            'avgSize','topRecipients',
            'ultimasSubs','ultimosDom','ultimosBuz'
        ));
    }
}
