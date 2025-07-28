@component('mail::message')
<img src="{{ asset('images/logo-connectia.png') }}"
     alt="Connectia Mail"
     style="max-height:50px; max-width:200px; margin-bottom:1rem;">

@php
    $expiresAt = $subscription->expires_at->format('d/m/Y');
    $graceEnd  = $subscription->grace_until->format('d/m/Y');
@endphp

@switch($daysBefore)
    @case(3)
# Hola {{ $subscription->name }},

Tu suscripción para **{{ $subscription->domain }}** expiró el **{{ $expiresAt }}**.  
Tienes una prórroga de **3 días** hasta el **{{ $graceEnd }}**.
    @break

    @case(2)
# Atención, {{ $subscription->name }}

Tu prórroga para **{{ $subscription->domain }}** vence en **2 días**, el **{{ $graceEnd }}**.
    @break

    @case(1)
# Última oportunidad, {{ $subscription->name }}

Hoy es el **último día** de prórroga para **{{ $subscription->domain }}**. Si no reactivas antes de medianoche, tu suscripción se cancelará definitivamente.
    @break
@endswitch

Para reactivar tu servicio sin interrupciones:

@component('mail::button', ['url' => route('subscriptions.reactivate', $subscription)])
Reactivar Suscripción
@endcomponent


Con aprecio,<br>
**Connectia Mail**<br>
soporte@connectia.info
@endcomponent
