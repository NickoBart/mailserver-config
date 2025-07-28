<?php

namespace App\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Subscription;

class SubscriptionExpired extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @var Subscription */
    public Subscription $subscription;

    /**
     * Create a new message instance.
     */
    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Tu suscripción ha expirado')
            ->markdown('emails.subscription_expired')
            ->with([
                'subscription' => $this->subscription,
            ]);
    }
}
