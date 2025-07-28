<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeClient extends Mailable
{
    use Queueable, SerializesModels;

    public $domain;
    public $password;

    public function __construct(string $domain, string $password)
    {
        $this->domain   = $domain;
        $this->password = $password;
    }

    public function build()
    {
        return $this
            ->subject("Tu acceso admin para {$this->domain}")
            ->markdown('emails.clients.welcome')
            ->with([
                'domain'   => $this->domain,
                'password' => $this->password,
            ]);
    }
}
