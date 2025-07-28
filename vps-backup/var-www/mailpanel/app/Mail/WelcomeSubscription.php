<?php

namespace App\Mail;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeSubscription extends Mailable
{
    use Queueable, SerializesModels;

    public Subscription $subscription;

    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    public function build()
    {
        return $this
            ->from('soporte@connectia.info', config('app.name'))
            ->subject("¡Bienvenido a " . config('app.name') . "!")
            ->markdown('emails.welcome_subscription')
            ->with([
                'name'   => $this->subscription->name,
                'domain' => $this->subscription->domain,
            ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome Subscription',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.welcome_subscription',
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
