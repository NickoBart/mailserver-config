<?php

namespace App\Mail;

use App\Models\ClientDomain;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class DnsCheckAlert extends Mailable
{
    use Queueable, SerializesModels;
    public ClientDomain $domain;

    public function __construct(ClientDomain $domain)
    {
        $this->domain = $domain;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('soporte@connectia.info', config('app.name')),
            subject: 'Alerta: error en validación DNS de tu dominio',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.dns_alert',
            with: [
                'domain' => $this->domain,
            ],
        );
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
