#!/usr/bin/env bash
set -e

# Nos aseguramos de estar en la raíz del repo
cd "$(dirname "$0")/.."

# Parar servicios
sudo systemctl stop postfix dovecot

# Copiar configuraciones
sudo cp -r postfix/* /etc/postfix/
sudo cp -r dovecot/* /etc/dovecot/

# Ajustar permisos
sudo chown root:root /etc/postfix/* /etc/dovecot/*

# Arrancar servicios
sudo systemctl start postfix dovecot

echo "Despliegue completado."
