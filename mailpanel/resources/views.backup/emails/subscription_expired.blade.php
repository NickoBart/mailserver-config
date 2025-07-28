@component('mail::message')
# Suscripción vencida

Hola {{ $subscription->name }},

Tu suscripción para **{{ $subscription->domain }}** ha expirado hoy.

Para reactivar el servicio, dirígete a nuestra página de contratación:

@component('mail::button', ['url' => route('subscribe.create')])
Reactivar suscripción
@endcomponent

Si deseas mantener todo tal como lo dejaste, al volver a pagar tu información y buzones seguirán disponibles.

@endcomponent
