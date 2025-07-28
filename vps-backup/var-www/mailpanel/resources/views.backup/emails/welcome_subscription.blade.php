<x-mail::message>
# ¡Hola {{ $name }}!

Gracias por contratar **{{ config('app.name') }}**.  
Hemos recibido tu solicitud para configurar el dominio **{{ $domain }}**.

Próximos pasos:

1. Verificaremos tu pago y activaremos tu cuenta.  
2. Una vez activo, recibirás otro correo con los datos de acceso y configuración final.

Si tienes dudas, responde a este mensaje o escríbenos a soporte@connectia.info.

¡Bienvenido a bordo!  
Saludos,  
El equipo de {{ config('app.name') }}

</x-mail::message>
