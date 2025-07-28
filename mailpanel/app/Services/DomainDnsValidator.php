<?php
namespace App\Services;

use App\Models\ClientDomain;

class DomainDnsValidator
{
    protected ClientDomain $domain;

    public function __construct(ClientDomain $domain)
    {
        $this->domain = $domain;
    }

    public function validate(): void
    {
        $host = preg_replace('#^https?://#', '', rtrim($this->domain->domain, '/'));

        // MX
        $mx = dns_get_record($host, DNS_MX);
        if (count($mx)) {
            $this->domain->mx_valid   = true;
            $this->domain->mx_message = 'MX apuntando a: '.implode(', ', array_column($mx,'target'));
        } else {
            $this->domain->mx_valid   = false;
            $this->domain->mx_message = 'No hay registros MX. Debes agregar un MX apuntando a mail.connectia.info';
        }

        // SPF
        $txt = dns_get_record($host, DNS_TXT);
        $spf = collect($txt)->first(fn($r)=> str_contains($r['txt'],'v=spf1'));
        if ($spf) {
            $this->domain->spf_valid   = true;
            $this->domain->spf_message = $spf['txt'];
        } else {
            $this->domain->spf_valid   = false;
            $this->domain->spf_message = 'No hay SPF (TXT con v=spf1). Añade: v=spf1 mx ~all';
        }

        // DKIM (selector "default")
        $dkimHost = "default._domainkey.{$host}";
        $dkimTxt  = dns_get_record($dkimHost, DNS_TXT);
        if (count($dkimTxt)) {
            $this->domain->dkim_valid   = true;
            $this->domain->dkim_message = implode(' ', array_column($dkimTxt,'txt'));
        } else {
            $this->domain->dkim_valid   = false;
            $this->domain->dkim_message = 'No hay DKIM en default._domainkey. Crea un TXT con tu clave pública.';
        }

        // DMARC
        $dmarcHost = "_dmarc.{$host}";
        $dmarcTxt  = dns_get_record($dmarcHost, DNS_TXT);
        if (count($dmarcTxt)) {
            $this->domain->dmarc_valid   = true;
            $this->domain->dmarc_message = implode(' ', array_column($dmarcTxt,'txt'));
        } else {
            $this->domain->dmarc_valid   = false;
            $this->domain->dmarc_message = 'No hay DMARC. Añade: v=DMARC1; p=none; rua=mailto:info@connectia.info; pct=100';
        }

        $this->domain->save();
    }
}
