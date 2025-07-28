<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriptionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_passes_subscription_and_flags_to_view()
    {
        // Crear usuario y suscripción
        $user = User::factory()->create(['email' => 'foo@example.com']);
        $sub = Subscription::factory()->create([
            'email' => 'foo@example.com',
            'expires_at' => now()->addDays(2),
            'status' => 'active',
            'plan_name' => 'Test Plan',
        ]);

        // Act as user y llamar la ruta
        $response = $this->actingAs($user)->get(route('subscription.show'));

        $response->assertStatus(200);
        $response->assertViewIs('subscriptions.status');
        $response->assertViewHasAll([
            'subscription' => $sub,
            'expired' => false,
            'daysLeft' => 2,
        ]);
    }
}
