<x-mail::message>
# ¡Hola {{ $name }}!

Tu dominio expirará el **{{ $expiresAt->format('d/m/Y') }}**.

Por favor, renueva antes de esa fecha para evitar interrupciones en el servicio.

¡Gracias por confiar en nosotros!

{{ config('app.name') }}
</x-mail::message>
