# Guía de Configuración de Correo

Este documento describe cómo añadir dominios y buzones, configurar registros DNS y probar el servicio de correo.

## 1. Registros DNS
- **A**: apunte `mail.tudominio.com` a la IP de tu VPS.
- **MX**: apunta el dominio principal a `mail.tudominio.com` con prioridad 10.
- **SPF**: crea un registro TXT: `v=spf1 mx -all`.
- **DKIM**: genera una clave DKIM con `amavisd` u `opendkim` y publica el selector en un registro TXT.
- **DMARC**: crea un registro TXT: `v=DMARC1; p=quarantine; rua=mailto:postmaster@tudominio.com`.

## 2. Crear cuentas y dominios
Las cuentas virtuales se almacenan en la base de datos MySQL. Utiliza el panel interno (aplicación Laravel) para:
1. Añadir un dominio.
2. Crear buzones especificando dirección y contraseña.
3. Asignar cuotas si aplica.

Alternativamente, puedes utilizar PostfixAdmin o manipular la base de datos directamente (no recomendado).

## 3. Configuración de clientes
- **IMAP/SMTP seguros**: usa IMAP sobre TLS (143 + STARTTLS) o IMAPS (993). Para enviar, configura SMTP en el puerto 587 con TLS obligatorio y autenticación.
- **Usuario**: la dirección completa del buzón (ej. `usuario@tudominio.com`).
- **Contraseña**: la que definiste al crear la cuenta.

## 4. Webmail
Roundcube está disponible en `https://mail.tudominio.com/roundcube/`. Inicia sesión con tus credenciales y asegúrate de confiar en el certificado TLS.

## 5. Pruebas y diagnóstico
- Verifica la entrega con `telnet` o `openssl s_client -connect mail.tudominio.com:587 -starttls smtp`.
- Comprueba que tus registros SPF/DKIM/DMARC estén publicados con herramientas como MXToolbox.
- Revisa los logs en `/var/log/mail.log` para solucionar problemas.

---

Para más detalles consulta la documentación oficial de Postfix y Dovecot.
