<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class MercadoPagoWebhookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_activates_subscription_when_webhook_called()
    {
        // Crear suscripción pendiente
        $sub = Subscription::factory()->create([
            'email' => 'baz@example.com',
            'status' => 'pending',
        ]);

        // Simular payload de MP
        $payload = ['data' => ['id' => $sub->preference_id]];
        Config::set('services.mercadopago.webhook_key', 'test_key');
        Http::fake([
            '*' => Http::response([], 200)
        ]);

        // Firma (puedes adaptar según tu implementación)
        $signature = hash_hmac('sha256', json_encode($payload), 'test_key');

        // Llamada al webhook
        $response = $this->postJson(route('mp.webhook'), $payload, [
            'x-mp-signature' => $signature,
        ]);

        $response->assertStatus(200);

        // Refrescar y comprobar
        $sub->refresh();
        $this->assertEquals('active', $sub->status);
    }
}
