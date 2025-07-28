<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuotaWarning extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $usage;

    public function __construct($username, $usage)
    {
        $this->username = $username;
        $this->usage    = $usage;
    }

    public function build()
    {
        return $this
            ->markdown('emails.quota.warning')
            ->subject("Alerta: tu buzón alcanzó el {$this->usage}% de cuota");
    }
}
