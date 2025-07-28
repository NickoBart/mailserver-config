<?php

namespace App\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Subscription;

class PaymentConfirmed extends Mailable implements ShouldQueue
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
            ->subject('Pago confirmado: tu suscripción está activa')
            ->markdown('emails.payment_confirmed')
            ->with([
                'subscription' => $this->subscription,
            ]);
    }
}
