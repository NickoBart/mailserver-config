Correo Corporativo Chile - Panel de Control

1. Introducción

Este proyecto es el panel de control de “Correo Corporativo Chile”, que permite gestionar dominios, buzones, suscripciones de pago vía Mercado Pago y flujos de expiración automatizados.

2. Requisitos Previos

PHP >= 8.1

Composer

MySQL

Extensiones PHP requeridas:

pdo_mysql

mbstring

openssl

tokenizer

xml

ctype

json

3. Instalación

git clone <repo-url> mailpanel
cd mailpanel
cp .env.example .env
composer install
php artisan key:generate

4. Configuración

Variables de entorno (.env)

APP_NAME="Correo Corporativo"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://panel.connectia.info

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mailserver
DB_USERNAME=root
DB_PASSWORD=secret

QUEUE_CONNECTION=database

# MercadoPago
MERCADOPAGO_ACCESS_TOKEN=
MERCADOPAGO_WEBHOOK_KEY=

Supervisor (Worker de Colas)

Crear el archivo /etc/supervisor/conf.d/mailpanel-worker.conf con este contenido:

[program:mailpanel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/mailpanel/artisan queue:work --sleep=3 --tries=3 --timeout=60
autostart=true
autorestart=true
user=www-data
numprocs=1
redirect_stderr=true
stdout_logfile=/var/www/mailpanel/storage/logs/worker.log

Recargar y arrancar Supervisor:

sudo supervisorctl reread
sudo supervisorctl update
sudo systemctl enable supervisor
sudo systemctl start supervisor

Cron (Scheduler)

Añadir al crontab (crontab -e):

* * * * * cd /var/www/mailpanel && php artisan schedule:run >> /dev/null 2>&1

5. Migraciones & Seeders

php artisan migrate
# Si dispones de seeders:
php artisan db:seed

6. Ejecutar Tests

php artisan test

7. Despliegue

Usar CI/CD (GitHub Actions, GitLab CI) para:

composer install --no-dev

php artisan migrate --force

php artisan config:cache

Ajustar permisos:

sudo chown -R www-data:www-data /var/www/mailpanel
sudo chmod -R 755 /var/www/mailpanel/storage
sudo chmod -R 755 /var/www/mailpanel/bootstrap/cache

Monitoreo de logs:

Archivo de logs: /var/www/mailpanel/storage/logs/laravel.log

8. Rutas Principales

/ → Página de inicio

/pricing → Planes y precios

/about → Acerca de Connectia Mail

/faq → Preguntas frecuentes

/checkout → Pantalla de contratación

/chat → Chat de soporte en vivo

9. Variables de Marca

Primario: #007BFF

Texto: #343A40

Fondo claro: #F4F6F9, #FEFEFE

10. Comandos Clave

Limpiar vistas: php artisan view:clear

Limpiar rutas: php artisan route:clear

Limpiar configuración: php artisan config:clear

Build producción: npm run build

Servidor desarrollo: npm run dev / php artisan serve

11. Checklist de Mejora Continua

Consulta el archivo CHANGELOG.md para ver el estado de tareas y pendientes.

12. Contacto

Para dudas o soporte interno, contáctanos en: soporte@connectia.info

