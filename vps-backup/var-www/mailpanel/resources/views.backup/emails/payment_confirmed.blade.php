@component('mail::message')
# ¡Pago recibido!

Hola {{ $subscription->name }},

Hemos recibido tu pago y tu suscripción está activa hasta **{{ $subscription->expires_at->format('d/m/Y') }}**.

Ya puedes usar tu correo “{{ $subscription->domain }}” sin problemas.

Gracias por confiar en nosotros.

@endcomponent
