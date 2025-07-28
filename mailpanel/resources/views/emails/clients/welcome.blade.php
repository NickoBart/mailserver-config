@component('mail::message')
# ¡Bienvenido!

Tu suscripción para **{{ $domain }}** está activa.

Puedes acceder al panel de administración con estas credenciales:

- **URL**: https://panel.connectia.info/login  
- **Usuario**: {{ 'admin@'.$domain }}
- **Contraseña**: `{{ $password }}`  

@component('mail::button', ['url' => 'https://panel.connectia.info/login'])
Ir al Panel
@endcomponent

Gracias por confiar en nosotros,<br>
{{ config('app.name') }}
@endcomponent
