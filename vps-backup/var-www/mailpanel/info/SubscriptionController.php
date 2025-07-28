<?php
namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeSubscription;

class SubscriptionController extends Controller
{
    public function create()
    {
        return view('subscribe.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'domain' => ['required','regex:/^([a-z0-9](?:[a-z0-9\-]{0,61}[a-z0-9])?\.)+[a-z]{2,}$/i']
        ]);

        // 1) Crear la suscripción
        $subscription = Subscription::create($data);

        // 2) Enviar correo de bienvenida inmediatamente usando sendmail
        Mail::to($subscription->email)
            ->send(new WelcomeSubscription($subscription));

        // (Más adelante enviaremos el email de bienvenida)
        return redirect()->route('subscribe.create')
                         ->with('success','¡Solicitud recibida! Te contactaremos pronto.');
    }
}
