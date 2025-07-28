#!/usr/bin/env bash
set -euo pipefail

# Ir al directorio raíz del repo
cd "$(dirname "$0")/.."

# Verificar sintaxis antes de aplicar cambios
postfix check
dovecot -n

# Detener servicios
sudo systemctl stop postfix dovecot

# Copiar únicamente los archivos esenciales
sudo install -m 644 postfix/main.cf /etc/postfix/main.cf
sudo install -m 644 postfix/master.cf /etc/postfix/master.cf
sudo cp -r dovecot/* /etc/dovecot/

# Regenerar mapas de Postfix
sudo postmap /etc/postfix/virtual || true
sudo postmap /etc/postfix/transport || true
sudo postmap /etc/postfix/recipient_canonical || true
sudo postmap /etc/postfix/sender_canonical || true

# Ajustar permisos
sudo chown -R root:root /etc/postfix /etc/dovecot

# Reiniciar servicios
sudo systemctl start postfix dovecot

echo "Despliegue completado y verificado."
