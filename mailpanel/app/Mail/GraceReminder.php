<?php

namespace App\Mail;

use Illuminate\Mail\Mailables\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Subscription;

class GraceReminder extends Mailable
{
    use Queueable, SerializesModels;

    public Subscription $subscription;
    public int $daysBefore;

    /**
     * @param Subscription $subscription
     * @param int $daysBefore Días antes de que termine la prórroga
     */
    public function __construct(Subscription $subscription, int $daysBefore)
    {
        $this->subscription = $subscription;
        $this->daysBefore  = $daysBefore;
    }

    /**
     * Configura un asunto dinámico según $daysBefore.
     */
    public function envelope(): Envelope
    {
        $subjects = [
            3 => 'Tu suscripción expiró: tienes 3 días de prórroga para reactivar el servicio',
            2 => 'Quedan 2 días de prórroga para reactivar tu suscripción',
            1 => 'Último día de prórroga: reactiva tu suscripción hoy',
        ];

        return new Envelope(
            from: new Address('soporte@connectia.info', 'Connectia Mail'),
            subject: $subjects[$this->daysBefore] ?? 'Recordatorio de prórroga'
        );
    }
    /**
     * Usa la plantilla Markdown de prórroga.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.expiry.grace'
        );
    }
}
