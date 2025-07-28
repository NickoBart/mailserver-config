<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExpiryReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $expiresAt;

    public function __construct(string $name, \DateTimeInterface $expiresAt)
    {
        $this->name      = $name;
        $this->expiresAt = $expiresAt;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu dominio expirará pronto'
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.expiry.reminder'
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
