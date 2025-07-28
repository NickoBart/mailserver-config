<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Mail\Mailables\Address;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Plan;

class SubscriptionController extends Controller
{
    /** Mostrar estado de la suscripción */
    public function show()
    {
        $user = auth()->user();
        $subscription = Subscription::where('email', $user->email)->first();
        $expired     = $subscription && $subscription->expires_at->isPast();
        $daysLeft    = $subscription
            ? now()->diffInDays($subscription->expires_at, false) + 1
            : null;

        return view('subscriptions.status', compact('subscription','expired','daysLeft'));
    }

    /** Mostrar formulario de checkout */
    public function create(Request $request)
    {
        if (! $request->has('plan_id')) {
            return redirect()->route('pricing');
        }

        $data = $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        $plan = Plan::findOrFail($data['plan_id']);
        $rate = Http::get('https://api.exchangerate-api.com/v4/latest/USD')
                   ->json('rates.CLP', 1);

        return view('checkout', compact('plan','rate'));
    }

    /** Guardar suscripción nueva */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'domain'         => ['required','regex:/^([a-z0-9](?:[a-z0-9\-]{0,61}[a-z0-9])?\.)+[a-z]{2,}$/i'],
            'plan_id'        => 'nullable|exists:plans,id',
            'period'         => 'required|in:monthly,annual',
            'quantity'       => 'required|integer|min:1|max:200',
            'billing_day'    => 'required|integer|min:1|max:28',
            // resto de campos…
        ]);

        $subscription = Subscription::create($data);

        // CALCULO PRORRATEO solo al crear nueva suscripción
        $unitPriceUsd = $subscription->plan->price_usd;
        $quantity     = $data['quantity'];
        $period       = $data['period'];

        if ($period === 'monthly') {
            // prorrateo hasta el próximo billing_day
            $today   = Carbon::today();
            $cutoff  = Carbon::create($today->year, $today->month, $data['billing_day']);
            if ($cutoff->lte($today)) {
                $cutoff->addMonth();
            }
            $daysToBill = $today->diffInDays($cutoff);
            $cycleDays  = $cutoff->copy()->subMonth()->diffInDays($cutoff);
            $proration  = $daysToBill / $cycleDays;
            $usdTotal   = $unitPriceUsd * $quantity * $proration;
        } else {
            $usdTotal = $unitPriceUsd * $quantity * 12 * 0.9;
        }

        $rateResponse = Http::get('https://api.exchangerate-api.com/v4/latest/USD');
        $rate         = $rateResponse->json('rates.CLP', 1);
        $clpTotal     = intval($usdTotal * $rate);

        $title = $period === 'monthly'
            ? "Suscripción mensual: {$subscription->plan->name}"
            : "Suscripción anual: {$subscription->plan->name} (10% dto)";

        $response = Http::withToken(config('services.mercadopago.access_token'))
            ->post('https://api.mercadopago.com/checkout/preferences', [
                'items' => [[
                    'title'       => $title,
                    'quantity'    => 1,
                    'unit_price'  => $clpTotal,
                    'currency_id' => 'CLP',
                ]],
                'payer'     => ['name' => $subscription->name, 'email' => $subscription->email],
                'back_urls' => [
                    'success' => route('subscribe.success'),
                    'failure' => route('subscribe.failure'),
                    'pending' => route('subscribe.pending'),
                ],
                'auto_return' => 'approved',
            ]);

        if ($response->failed()) {
            return redirect()->route('subscribe.create')
                             ->with('error','Error al iniciar el pago. Intenta nuevamente.');
        }

        $body = $response->json();
        $subscription->update([
            'preference_id' => $body['id'],
            'init_point'    => $body['init_point'],
        ]);

        return redirect()->away($body['init_point']);
    }

    /**
     * Reactivar suscripción desde la zona de gracia
     */
    public function reactivate(Request $request, Subscription $subscription)
    {
        $period = $request->input('period', 'monthly');
        $unit   = $subscription->plan->price_usd;
        $qty    = $subscription->quantity;

        // Calcular USD total
        if ($period === 'annual') {
            $usdTotal = $unit * $qty * 12 * 0.9;
        } else {
            $usdTotal = $unit * $qty;
        }

        // Obtener tasa CLP de forma segura
        $resp = Http::get('https://api.exchangerate-api.com/v4/latest/USD');
        $data = json_decode($resp->body(), true);
        $rate = data_get($data, 'rates.CLP', 1);

        $clpTotal = intval($usdTotal * $rate);

        $title = $period === 'annual'
            ? "Renovación anual: {$subscription->plan->name} (10% dto)"
            : "Renovación mensual: {$subscription->plan->name}";

        $mpResponse = Http::withToken(config('services.mercadopago.access_token'))
            ->post('https://api.mercadopago.com/checkout/preferences', [
                'items' => [[
                    'title'       => $title,
                    'quantity'    => 1,
                    'unit_price'  => $clpTotal,
                    'currency_id' => 'CLP',
                ]],
                'payer'     => [
                    'name'  => $subscription->name,
                    'email' => $subscription->email,
                ],
                'back_urls' => [
                    'success' => route('subscription.show'),
                    'failure' => route('subscribe.failure'),
                    'pending' => route('subscribe.pending'),
                ],
                'auto_return' => 'approved',
            ]);

        $body = $mpResponse->json();
        $subscription->update([
            'preference_id' => $body['id'],
            'init_point'    => $body['init_point'],
        ]);

        return redirect()->away($body['init_point']);
    }

}
