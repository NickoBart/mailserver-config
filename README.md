# Configuración de Servidor de Correo

Este repositorio contiene la configuración de Postfix y Dovecot para un servidor de correo virtual con base en MySQL, así como scripts de despliegue y documentación.

## Estructura del repositorio

- **postfix/**: Archivos de configuración `main.cf` y `master.cf` para Postfix.
- **dovecot/**: Configuración modular de Dovecot (`conf.d`) y archivo `dovecot-sql.conf.ext` para usuarios virtuales.
- **scripts/**: Scripts de despliegue automáticos para copiar y validar las configuraciones.
- **docs/**: Guías de configuración, como `configurar_correo.md`, que explica pasos para DNS, DKIM, DMARC y clientes de correo.
- **.gitignore**: Lista de archivos y directorios excluidos del control de versiones (respaldos, logs y secretos).

## Cómo usarlo

1. Clona este repositorio en tu servidor:
   ```bash
   git clone git@github.com:NickoBart/mailserver-config.git
   cd mailserver-config
   ```
2. Ajusta las configuraciones de Postfix y Dovecot según tus dominios y credenciales (ver `dovecot/dovecot-sql.conf.ext`).
3. Ejecuta el script de despliegue para aplicar cambios:
   ```bash
   sudo bash scripts/deploy.sh
   ```
4. Consulta la guía `docs/configurar_correo.md` para pasos sobre DNS, certificados TLS, DKIM/DMARC y configuración de clientes.

## Contribuciones

Las sugerencias y mejoras son bienvenidas. Por favor, abre un issue o pull request con tus cambios.
