#!/usr/bin/env bash
set -e
sudo systemctl stop postfix dovecot
sudo cp -r ../postfix/* /etc/postfix/
sudo cp -r ../dovecot/* /etc/dovecot/
sudo chown root:root /etc/postfix/* /etc/dovecot/*
sudo systemctl start postfix dovecot
echo "Despliegue completado."
