<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use App\Models\Subscription;

class ExpireSubscriptionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_expires_subscriptions_and_sends_email()
    {
        Mail::fake();

        // Crear una suscripción expirada
        $sub = Subscription::factory()->create([
            'email' => 'bar@example.com',
            'expires_at' => now()->subDay(),
            'status' => 'active',
        ]);

        // Ejecutar el comando
        Artisan::call('expire:subscriptions');

        // Refrescar el modelo y comprobar
        $sub->refresh();
        $this->assertEquals('cancelled', $sub->status);

        // Comprobar que el email de expiración fue enviado
        Mail::assertQueued(\App\Mail\SubscriptionExpired::class);
    }
}
