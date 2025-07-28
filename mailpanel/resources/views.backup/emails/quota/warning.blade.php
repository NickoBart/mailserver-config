<x-mail::message>
# Alerta de cuota

El buzón **{{ $username }}** ha alcanzado el **{{ $usage }} %** de su cuota.

Por favor, libera espacio o aumenta tu cuota para evitar la suspensión del servicio.

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
