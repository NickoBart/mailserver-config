<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ClientDomain;

class VerifyDomainRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domains:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica registros MX, SPF, DKIM y DMARC de cada dominio y actualiza su estado';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $domains = ClientDomain::all();
        if ($domains->isEmpty()) {
            $this->warn('No hay dominios para verificar.');
            return 0;
        }

        foreach ($domains as $domain) {
            // Normalizar sin esquema
            $name = preg_replace('#^https?://#', '', $domain->domain);
            $this->info("Verificando {$name}...");

            // Registros DNS
            $mx    = @dns_get_record($name, DNS_MX);
            $txt   = @dns_get_record($name, DNS_TXT);
            $dmarc = @dns_get_record('_dmarc.'.$name, DNS_TXT);
            $dkim  = @dns_get_record('default._domainkey.'.$name, DNS_TXT);

            // Chequeos
            $hasMx    = ! empty($mx);
            $hasSpf   = false;
            foreach ($txt as $rec) {
                if (isset($rec['txt']) && stripos($rec['txt'], 'v=spf1') === 0) {
                    $hasSpf = true;
                    break;
                }
            }
            $hasDkim  = ! empty($dkim);
            $hasDmarc = ! empty($dmarc);

            $verified = $hasMx && $hasSpf && $hasDkim && $hasDmarc;
            $domain->update(['verified' => $verified]);

            $this->line($verified
                ? "✅ {$name} verificado (MX, SPF, DKIM, DMARC)"
                : "❌ {$name} NO verificado"
            );
        }

        $this->info('✅ Proceso de verificación completado.');
        return 0;
    }
}
