@component('mail::message')
# Alertas de métricas

@foreach ($alerts as $alert)
- {{ $alert }}
@endforeach

Gracias,<br>
Connectia Mail Bot
@endcomponent
