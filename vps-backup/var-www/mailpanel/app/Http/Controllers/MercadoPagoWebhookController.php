<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientLogin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Subscription;
use App\Mail\WelcomeSubscription;
use App\Mail\PaymentConfirmed;
use App\Mail\WelcomeClient;
use Carbon\Carbon;
use App\Models\User;

class MercadoPagoWebhookController extends Controller
{
    /**
     * Handle the incoming MercadoPago webhook.
     */
    public function handle(Request $request)
    {
        // Log inicial para confirmar que llegamos
        Log::info('MP Webhook received', ['headers' => $request->headers->all()]);

        $payload   = $request->getContent();
        $signature = $request->header('X-MercadoPago-Signature');
        $secret    = env('MERCADOPAGO_WEBHOOK_KEY');

        // 1) Validar firma sólo si viene
        if ($signature) {
            $calculated = hash_hmac('sha256', $payload, $secret);
            if (! hash_equals($calculated, $signature)) {
                Log::warning('MP Webhook signature mismatch', [
                    'calculated' => $calculated,
                    'provided'   => $signature,
                ]);
                return response()->json(['error' => 'Invalid signature'], 400);
            }
        } else {
            Log::info('MP Webhook: no signature header, skipping validation (simulation)');
        }

        // 2) Procesar payload
        $data = $request->json()->all();
        Log::info('MP Webhook payload', ['data' => $data]);

        $preferenceId = data_get($data, 'data.id');
        if ($preferenceId) {
            $sub = Subscription::where('preference_id', $preferenceId)->first();

            if ($sub) {
                // 3) Activar y fijar expiración a 1 mes
                $sub->update([
                    'status'     => 'active',
                    'expires_at' => Carbon::now()->addMonth(),
                ]);

                // 4) Enviar email de confirmación de pago
                Mail::to($sub->email)->queue(new PaymentConfirmed($sub));

                // 5) Crear o actualizar el Client admin y generar contraseña aleatoria
                $randomPass = Str::random(12);
                // Guardamos la contraseña plana en sesión para el Observer
                session(['new_client_plain' => $randomPass]);

                // 5.b) Crear/actualizar el Client admin@<dominio> para login
                $loginEmail = 'admin@' . $sub->domain;
                $client = Client::updateOrCreate(
                    ['email'    => $loginEmail],
                    [
                        'name'     => $sub->name,
                        'password' => Hash::make($randomPass),
                    ]
                );

                // 5.c) Crear/actualizar el User para el guard web
                User::updateOrCreate(
                    ['email'    => $loginEmail],
                    [
                        'name'     => $sub->name,
                        'password' => Hash::make($randomPass),
                    ]
                );

                Log::info("Client {$client->id} y User sincronizado para {$sub->email} con dominio {$sub->domain}");
            }
        }

        return response()->json(['status' => 'ok'], 200);
    }
}
