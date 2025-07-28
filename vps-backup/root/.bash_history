driver = mysql
connect = host=localhost dbname=postfixadmin user=pfadmin password=P4ssw0rdSeguro!
default_pass_scheme = MD5-CRYPT
password_query = SELECT username AS user, password FROM mailbox WHERE username = '%u'
user_query = SELECT maildir AS home FROM mailbox WHERE username = '%u'
EOF

sudo doveadm force-resync -u soporte@connectia.info '*'
sudo systemctl restart dovecot postfix
# Probar autenticación sin userdb
doveadm auth test soporte@connectia.info Soyelniko1 -x userdb
# Si funciona, probar con userdb
doveadm auth test soporte@connectia.info Soyelniko1
dovecot --version
# Dovecot v2.3.16 (7e2e900c1a)
clear
cat /etc/roundcube/config.inc.php
grep -ni "smtp" /etc/roundcube/config.inc.php
ls -lh /etc/roundcube/
ls -lh /usr/share/roundcube/config/
grep -ni "smtp_server" /etc/roundcube/defaults.inc.php
grep -ni "localhost" /etc/roundcube/defaults.inc.php
ls -lh /var/log/roundcube/smtp.log
ls -ld /var/log/roundcube
stat /var/log/roundcube/smtp.log
stat /var/log/roundcube
ps aux | grep php-fpm | grep -v grep
# O si usas apache:
ps aux | grep apache2 | grep -v grep
grep -A 10 "^submission" /etc/postfix/master.cf
grep -E "^smtpd_|^submission_" /etc/postfix/main.cf
grep -i "auth" /etc/dovecot/dovecot.conf
grep -ir "auth" /etc/dovecot/conf.d/
ls -l /var/spool/postfix/private/auth
ss -tlnp | grep -E "993|587"
openssl s_client -connect mail.connectia.info:587 -starttls smtp
sudo tail -n 40 /var/log/mail.log
sudo tail -n 40 /var/log/roundcube/errors.log
sudo tail -n 40 /var/log/roundcube/smtp.log
php -m | grep -E "openssl|sockets|mbstring|intl|xml|json|pdo|mysql"
sudo rm -rf /var/cache/roundcube/skins_*.php /var/lib/roundcube/temp/* /var/lib/roundcube/cache/*
sudo systemctl reload php8.1-fpm
sudo systemctl reload apache2
clear
nano /etc/roundcube/config.inc.php
sudo rm -rf /var/cache/roundcube/skins_*.php /var/lib/roundcube/temp/* /var/lib/roundcube/cache/*
sudo systemctl reload php8.1-fpm
sudo systemctl reload apache2
clear
ss -tlnp | grep 993
openssl s_client -connect mail.connectia.info:993
sudo tail -n 40 /var/log/mail.log
sudo tail -n 40 /var/log/roundcube/errors.log
clear
USE postfixadmin;
SELECT username, home FROM mailbox WHERE username='soporte@connectia.info';
ls /var/mail/vhosts/connectia.info/soporte/
ls /home/vmail/connectia.info/soporte/
ls /var/mail/connectia.info/soporte/
clear
root@vmi2599867:~# USE postfixadmin;
SELECT username, home FROM mailbox WHERE username='soporte@connectia.info';
USE: command not found
SELECT: command not found
root@vmi2599867:~# ls /var/mail/vhosts/connectia.info/soporte/
ls /home/vmail/connectia.info/soporte/
ls /var/mail/connectia.info/soporte/
ls: cannot access '/home/vmail/connectia.info/soporte/': No such file or directory
ls: cannot access '/var/mail/connectia.info/soporte/': No such file or directory
root@vmi2599867:~#
clear
ls -l /var/mail/vhosts/connectia.info/soporte/
ls -l /var/mail/vhosts/connectia.info/
ls -l /var/mail/vhosts/
mysql -u root -p
clear
sudo grep -i "mail_location" /etc/dovecot/conf.d/10-mail.conf
cat sudo nano /etc/dovecot/conf.d/10-mail.conf
ls -lt  /etc/dovecot/conf.d/
ls -lt  /etc/dovecot/
sudo nano /etc/dovecot/conf.d/10-mail.conf
id vmail
sudo systemctl restart dovecot
clear
sudo tail -n 40 /var/log/mail.log
sudo tail -n 40 /var/log/roundcube/errors.log
clear
sudo nano /etc/dovecot/dovecot-sql.conf.ext
cat /etc/dovecot/dovecot-sql.conf.ext
nano /etc/dovecot/conf.d/10-mail.conf
sudo systemctl restart dovecot
clear
ls -l /var/mail/vhosts/connectia.info/soporte/
ls -l /var/mail/vhosts/connectia.info/soporte/cur
ls -l /var/mail/vhosts/connectia.info/soporte/new
ls -ld /var/mail/vhosts/connectia.info/soporte/
ls -l /var/mail/vhosts/connectia.info/soporte/
sudo tail -f /var/log/mail.log
cat sudo nano /etc/roundcube/config.inc.php
clear
mysql -u root -p
sudo systemctl restart dovecot
sudo systemctl restart postfix
find /var/mail/vhosts/ -type f -name '*'
clear
sudo tail -n 50 /var/log/mail.log
sudo tail -n 50 /var/log/roundcube/smtp.log
dig +short TXT connectia.info
clear
sudo tail -n 100 /var/log/roundcube/smtp.log
sudo tail -n 100 /var/log/roundcube/errors.log
grep -r smtp_ /etc/roundcube/
sudo apt install swaks
swaks --to=ndonoso.partner7@gmail.com --from=soporte@connectia.info       --server mail.connectia.info:587 --auth       --auth-user soporte@connectia.info --auth-password Soyelniko1 --tls
sudo nano /etc/hosts
cat /etc/hosts
cat /etc/postfix/master.cf
clear
cat /etc/roundcube/config.inc.php
sudo mv /etc/roundcube/config.inc.php.save /etc/roundcube/config.inc.php.save.bak
sudo rm -rf /var/lib/roundcube/temp/*
sudo rm -rf /var/lib/roundcube/session/*
sudo systemctl restart apache2
ls -l /etc/roundcube/config.inc.php
clear
nano /etc/hosts
nano /etc/roundcube/config.inc.php
sudo rm -rf /var/lib/roundcube/temp/*
sudo rm -rf /var/lib/roundcube/session/*
sudo systemctl restart apache2
sudo tail -n 100 /var/log/roundcube/smtp.log
clear
ls -l /etc/roundcube/config.inc.php
ls -l /etc/roundcube/config.d/
$config['smtp_server'] = 'localhost';
cat /etc/roundcube/defaults.inc.php
sudo nano /etc/roundcube/config.inc.php
sudo systemctl restart apache2
clear
sudo nano /etc/roundcube/config.inc.php
sudo find / -name config.inc.php 2>/dev/null
clear
nano /var/www/html/roundcube
nano /etc/roundcube/config.inc.php
nano /var/www/html/roundcube
clear
sudo find /var/www/html/ -name config.inc.php 2>/dev/null
sudo find /usr/share/roundcube/ -name config.inc.php 2>/dev/null
clear
nano /var/www/html/roundcube
nano /etc/roundcube/config.inc.php
cat /etc/roundcube/config.inc.php
clear
nano /etc/roundcube/config.inc.php
sudo rm -rf /var/lib/roundcube/temp/*
sudo rm -rf /var/lib/roundcube/session/*
sudo systemctl restart apache2
clear
sudo tail -f /var/log/roundcube/smtp.log
sudo tail -f /var/log/mail.log
clear
sudo chown www-data:www-data /var/log/roundcube/smtp.log
sudo chmod 644 /var/log/roundcube/smtp.log
clear
sudo tail -f /var/log/roundcube/smtp.log
sudo tail -f /var/log/mail.log
clear
sudo postconf -n | grep sasl
openssl s_client -starttls smtp -connect mail.connectia.info:587 -crlf
cat /etc/postfix/main.cf
cat /etc/dovecot/conf.d/10-master.conf
clear
cd /var/www/postfixadmin/
php ./scripts/postfixadmin-cli mailbox password soporte@connectia.info
sudo php ./scripts/postfixadmin-cli mailbox password soporte@connectia.info
mysql -u root -p
clear
doveadm pw -s MD5-CRYPT -p 'Soyelniko1'
mysql -u root -p
sudo systemctl restart postfix dovecot
clear
mysql -u root -p
clear
cd /var/www/mailpanel/
ls -lt
cat .env
clear
# Ve al directorio de tu panel
cd /var/www/mailpanel
# Busca conexiones a postfixadmin o "pfadmin"
grep -Ri "postfixadmin" .
grep -Ri "pfadmin" .
grep -Ri "DB::connection" .
grep -Ri "buzons"
grep -Ri "mailbox"
clear
grep -Ri "postfixadmin" .
clear
grep -Ri "pfadmin" .
clear
mysql -u root -p
clear
mysql -u root -p
clear
nano /var/www/roundcube/config/config.inc.php
cd ..
ls -lt
cd ..
le -lt
ls lt-
ls -lt
cd ..
ls -lt
cd etc
ls -lt
cd roundcube
ls -lt
cat config.inc.php
clear
sudo tail -f /var/log/mail.log /var/log/roundcube/errors.log
clear
sudo tail -f /var/log/mail.log /var/log/roundcube/errors.log
clear
nano /etc/postfix/master.cf
cat /etc/postfix/master.cf
openssl s_client -connect 127.0.0.1:587 -starttls smtp
clear
nano /etc/postfix/main.cf
cat /etc/postfix/main.cf
cat /etc/dovecot/conf.d/10-master.conf
clear
nano /etc/dovecot/conf.d/10-master.conf
sudo systemctl restart dovecot
sudo systemctl restart postfix
ls -l /var/spool/postfix/private/auth
sudo tail -f /var/log/mail.log /var/log/roundcube/errors.log
clear
mysql -u root -p
# Contraseña: Soyelniko1
clear
mysql -u root -p
clear
cd /var/www/panel # o la ruta donde esté tu panel web
grep -Ri "mysql" .
grep -Ri "postfixadmin"
grep -Ri "mailserver"
clear
cd /var/www/
grep -Ri "buzons"
grep -Ri "mailbox"
grep -Ri "INSERT INTO"
grep -Ri "UPDATE"
grep -Ri "TRIGGER"
clear
cd /var/www/panel # (ajusta si la ruta es otra)
grep -Ri "mysql" .
clear
cd cd /var/www/panel # (ajusta si la ruta es otra)
grep -Ri "mysql" .
clear
cd mailpanel
clear
ls -lt
nano nano /etc/roundcube/config.inc.php
sudo systemctl restart postfix
sudo systemctl stop postfixix
sudo systemctl start postfix
nano /etc/roundcube/config.inc.php
sudo systemctl restart dovecot
sudo systemctl restart postfix
nano /usr/share/roundcube/program/lib/Roundcube/rcube.php
cat /usr/share/roundcube/program/lib/Roundcube/rcube.php
clear
cat /etc/roundcube/config.inc.php | grep -i smtp -A 5
cat /usr/share/roundcube/config/config.inc.php | grep -i smtp -A 5
clear
nano /etc/roundcube/config.inc.php
sudo systemctl restart apache2
# o
sudo systemctl restart php8.1-fpm
cat /etc/roundcube/config.inc.php
clear
nano /etc/roundcube/config.inc.php
cat /etc/roundcube/config.inc.php
clear
nano /etc/roundcube/config.inc.php
sudo systemctl restart apache2
# o
sudo systemctl restart php8.1-fpm
sudo systemctl restart dovecot
sudo systemctl restart postfix
nano /usr/share/roundcube/plugins
cd /usr/share/roundcube/plugins/
ls -lt
clear
cat /usr/share/roundcube/VERSION
cat /var/www/html/roundcube/VERSION
grep 'RCMAIL_VERSION' /usr/share/roundcube/program/include/iniset.php
grep -i version /usr/share/roundcube/program/include/iniset.php
ls -l /var/spool/postfix/private/auth
clear
lsb_release -a 2>/dev/null || cat /etc/os-release
uname -a
dpkg -l | grep roundcube
apt-cache policy roundcube
php -v
ls -l /etc/roundcube/config.inc.php
ls -l /usr/share/roundcube/config/config.inc.php
# Esto solo hace copia, no modifica nada
cp /etc/roundcube/config.inc.php /root/config.inc.php.bak 2>/dev/null || echo "Ya está respaldado"
cp -r /usr/share/roundcube/plugins /root/rc-plugins-backup 2>/dev/null || echo "Ya está respaldado"
clear
cd /usr/share/
wget https://github.com/roundcube/roundcubemail/releases/download/1.6.7/roundcubemail-1.6.7-complete.tar.gz
tar -czvf /root/roundcube-backup-$(date +%F).tar.gz roundcube/
tar -xzvf roundcubemail-1.6.7-complete.tar.gz
cp /etc/roundcube/config.inc.php roundcubemail-1.6.7/config/
cp -r roundcube/plugins/* roundcubemail-1.6.7/plugins/
clear
ls roundcube/plugins/
ls roundcubemail-1.6.7/plugins/
cp /etc/roundcube/config.inc.php roundcubemail-1.6.7/config/
mv roundcube roundcube-old
mv roundcubemail-1.6.7 roundcube
chown -R www-data:www-data /usr/share/roundcube
cd /usr/share/roundcube
php bin/update.sh
systemctl restart apache2
clear
tail -n 40 /var/log/roundcube/errors.log
ls /usr/share/roundcube/logs/
tail -n 40 /usr/share/roundcube/logs/errors.log
chown -R www-data:www-data /usr/share/roundcube
cat /etc/apache2/sites-enabled/* | grep -i roundcube -B 5 -A 10
clear
apt install composer
cd /usr/share/roundcube
composer install --no-dev
clear
apt install php8.1-ldap
systemctl restart apache2
cd /usr/share/roundcube
composer install --no-dev
clear
rm -rf /usr/share/roundcube/temp/*
rm -rf /usr/share/roundcube/cache/*
chown -R www-data:www-data /usr/share/roundcube
systemctl restart apache2
tail -n 40 /usr/share/roundcube/logs/errors.log
tail -n 40 /var/log/apache2/panel.error.log
clear
/usr/share/roundcube/config/config.inc.php
/etc/roundcube/config.inc.php
clear
nano /usr/share/roundcube/config/config.inc.php
cat /usr/share/roundcube/config/config.inc.php
clear
cat /etc/roundcube/config.inc.php | grep db_dsnw
mysql -u root -p
nano /usr/share/roundcube/config/config.inc.php
systemctl restart apache2
mysql -u root -p -e "SHOW DATABASES;"
mysql -u root -p -e "SELECT User,Host FROM mysql.user;"
clear
systemctl restart apache2
tail -n 40 /usr/share/roundcube/logs/errors.log
clear
nano /usr/share/roundcube/config/config.inc.php
systemctl restart apache2
tail -n 40 /usr/share/roundcube/logs/errors.log
clear
nano /etc/postfix/master.cf
systemctl restart postfix
apt install libsasl2-modules postfix-sqlite postfix-mysql dovecot-core dovecot-imapd dovecot-pop3d
systemctl restart postfix dovecot
nano /usr/share/roundcube/config/config.inc.php
systemctl restart apache2
cat /etc/postfix/master.cf
cat /usr/share/roundcube/config/config.inc.php
clear
cat /var/spool/postfix/private/auth
cd /var/spool/postfix/private/auth
cd /var/spool/postfix/private/auth/
nano /var/spool/postfix/private/auth
clear
ls -l /var/spool/postfix/private/auth
nano /etc/dovecot/conf.d/10-master.conf
systemctl restart dovecot
ls -l /var/spool/postfix/private/auth
nano  /etc/postfix/main.cf
cat /etc/postfix/main.cf
grep -A 5 'service auth' /etc/dovecot/conf.d/10-master.conf
clear
tail -n 50 /var/log/mail.log
tail -n 50 /usr/share/roundcube/logs/errors.log
clear
nano /etc/dovecot/conf.d/10-auth.conf
openssl s_client -connect localhost:587 -starttls smtp -crlf
nano /usr/share/roundcube/config/config.inc.php
openssl s_client -connect localhost:587 -starttls smtp -crlf
systemctl restart dovecot
systemctl restart postfix
clear
df -h
du -h --max-depth=2 /var | sort -hr | head -n 30
ls -lh /var/mail/vhosts/connectia.info/
dmesg | tail -n 30
tail -n 50 /var/log/mail.log
tail -n 50 /usr/share/roundcube/logs/errors.log
df -h /tmp
ls -lh /tmp | sort -hr | head -n 30
clear
cat /etc/dovecot/conf.d/90-quota.conf
cat /etc/dovecot/conf.d/10-mail.conf
cat /etc/dovecot/dovecot-sql.conf.ext
doveadm quota get -u noticias@connectia.info
cat /etc/dovecot/conf.d/10-mail.conf
cat /etc/dovecot/conf.d/90-quota.conf
cat /etc/dovecot/dovecot-sql.conf.ext | grep quota
cat /usr/share/roundcube/config/config.inc.php | grep -i imap -A 10
tail -n 100 /var/log/mail.log | grep quota
clear
dovecot -a | grep plugin
# Conéctate a tu base de datos (usualmente MySQL o MariaDB)
mysql -u pfadmin -p
# Luego ejecuta (dentro de mysql):
USE postfixadmin;
DESCRIBE mailbox;
SELECT username, quota, active FROM mailbox WHERE username='noticias@connectia.info';
grep -i plugins /usr/share/roundcube/config/config.inc.php
ls -l /var/mail/vhosts/connectia.info/noticias/Maildir/
ls -l /var/mail/vhosts/connectia.info/noticias/Maildir/.Sent
sudo -u vmail maildirmake /var/mail/vhosts/connectia.info/noticias/Maildir/.Sent
ls -l /usr/share/roundcube/plugins/
cat /usr/share/roundcube/plugins/quota/config.inc.php 2>/dev/null
tail -f /var/log/mail.log
# Envía un correo desde Roundcube y mira el log en tiempo real, y pega aquí lo que aparezca cuando ocurre el error.
id vmail
clear
ls -lh /var/mail/vhosts/connectia.info/
ls -lh /var/mail/vhosts/connectia.info/soporte/
ls -lh /var/mail/vhosts/connectia.info/soporte/Maildir/
ls -lh /var/mail/vhosts/connectia.info/soporte/Maildir/.Sent
clear
sudo -u vmail doveadm mailbox create -u soporte@connectia.info Sent
ls -lh /var/mail/vhosts/connectia.info/soporte/Maildir/
ls -lh /var/mail/vhosts/connectia.info/soporte/Maildir/.Sent
clear
sudo doveadm mailbox list -u soporte@connectia.info
ls -l /var/mail/vhosts/connectia.info/soporte/
ls -l /var/mail/vhosts/connectia.info/soporte/Maildir/
ls -l /var/mail/vhosts/connectia.info/soporte/Maildir/.Sent
cat /var/mail/vhosts/connectia.info/soporte/Maildir/subscriptions
tail -f /var/log/mail.log | grep soporte
ls -lh /var/mail/vhosts/connectia.info/soporte/Maildir/new/
ls -lh /var/mail/vhosts/connectia.info/soporte/Maildir/cur/
sudo doveadm mailbox list -u soporte@connectia.info
sudo doveadm fetch -u soporte@connectia.info 'mailbox-guid' mailbox
ls -lh /var/mail/vhosts/connectia.info/soporte/
ls -lh /var/mail/vhosts/connectia.info/soporte/Maildir/
cat /var/mail/vhosts/connectia.info/soporte/Maildir/subscriptions 2>/dev/null || echo "No existe archivo de suscripciones"
clear
sudo systemctl status dovecot
sudo systemctl restart dovecot
ls -l /var/run/dovecot/lmtp
ls -l /run/dovecot/
sudo tail -n 50 /var/log/mail.log | grep dovecot
cat /etc/dovecot/conf.d/10-master.conf
ls -l /var/mail/vhosts/connectia.info/
ls -ld /var/mail/vhosts/connectia.info/soporte/
ls -ld /var/mail/vhosts/connectia.info/soporte/Maildir/
clear
sudo -u vmail maildirmake.dovecot /var/mail/vhosts/connectia.info/soporte/Maildir
sudo -u vmail maildirmake.dovecot /var/mail/vhosts/connectia.info/soporte/Maildir/.Sent
sudo -u vmail maildirmake.dovecot /var/mail/vhosts/connectia.info/soporte/Maildir/.Drafts
sudo -u vmail maildirmake.dovecot /var/mail/vhosts/connectia.info/soporte/Maildir/.Trash
sudo -u vmail maildirmake.dovecot /var/mail/vhosts/connectia.info/soporte/Maildir/.Junk
sudo chown -R vmail:basic /var/mail/vhosts/connectia.info/soporte/
sudo chmod -R 770 /var/mail/vhosts/connectia.info/soporte/
clear
df -h
repquota -a 2>/dev/null || echo "No hay cuotas de disco activas"
quota -u vmail
ls -ld /var/mail/vhosts/connectia.info/soporte/
ls -ld /var/mail/vhosts/connectia.info/
df -i
clear
ls -l /var/mail/vhosts/connectia.info/soporte/
ls -l /var/mail/vhosts/connectia.info/soporte/Maildir*
mysql -u pfadmin -p
cd /var/www/mailpanel/
cat .env
clear
ls -l /var/mail/vhosts/connectia.info/soporte/
ls -l /var/mail/vhosts/connectia.info/soporte/Maildir*
mysql -u pfadmin -p'P4ssw0rdSeguro!' -h 127.0.0.1 postfixadmin
sudo su - vmail -s /bin/bash
mkdir -p /var/mail/vhosts/connectia.info/soporte/Maildir
exit
aa-status 2>/dev/null || echo "No hay AppArmor"
getenforce 2>/dev/null || echo "No hay SELinux"
mysql -u root -p'Soyelniko1' -h 127.0.0.1 mailserver
clear
ls -l /var/mail/vhosts/connectia.info/soporte/Maildir/maildirsize
sudo su - vmail -s /bin/bash
mkdir -p /var/mail/vhosts/connectia.info/soporte/Maildir
maildirmake.dovecot /var/mail/vhosts/connectia.info/soporte/Maildir/.Sent
maildirmake.dovecot /var/mail/vhosts/connectia.info/soporte/Maildir/.Drafts
maildirmake.dovecot /var/mail/vhosts/connectia.info/soporte/Maildir/.Trash
maildirmake.dovecot /var/mail/vhosts/connectia.info/soporte/Maildir/.Junk
exit
clear
rm -rf /var/mail/vhosts/connectia.info/soporte/Maildir
ls -l /var/mail/vhosts/connectia.info/soporte/Maildir
sudo su - vmail -s /bin/bash
sudo chown -R vmail:basic /var/mail/vhosts/connectia.info/soporte/
sudo chmod -R 770 /var/mail/vhosts/connectia.info/soporte/
clear
find /var/mail/vhosts/connectia.info/soporte/ -name "maildirsize" -exec rm -f {} \;
ls -la /var/mail/vhosts/connectia.info/soporte/
rm -f /var/mail/vhosts/connectia.info/soporte/maildirsize
systemctl restart dovecot
sudo su - vmail -s /bin/bash
cat /etc/fstab
sudo su - vmail -s /bin/bash
clear
sudo repquota -a
id vmail
sudo setquota -u vmail 0 0 0 0 /      # (eso quita límites de bloques/inodos para vmail en la raíz "/")
sudo su - vmail -s /bin/bash
sudo setquota -u vmail 10000000 11000000 1000000 1100000 /
sudo su - vmail -s /bin/bash
sudo repquota -a
sudo setquota -u vmail 0 0 0 0 /
sudo repquota -a | grep vmail
clear
sudo quotacheck -vagum
sudo quotaon -av
sudo su - vmail -s /bin/bash
quota -u vmail
sudo repquota -a | grep vmail
clear
sudo systemctl stop dovecot
sudo systemctl stop postfix
sudo quotaoff -a
sudo rm -f /aquota.user /aquota.group //aquota.user //aquota.group /quota.user /quota.group
sudo quotaon -av
sudo su - vmail -s /bin/bash
mkdir -p /var/mail/vhosts/connectia.info/soporte/Maildir
exit
clear
nano /etc/roundcube/config.inc.php
openssl s_client -starttls smtp -connect mail.connectia.info:587
EHLO prueba.com
sudo systemctl stop postfix
sudo systemctl start postfix
openssl s_client -starttls smtp -connect mail.connectia.info:587
EHLO prueba.com
nano /etc/roundcube/config.inc.php
sudo systemctl restart dovecot
sudo systemctl restart postfix
sudo systemctl restart dovecot
sudo systemctl restart postfix
sudo tail -f /var/log/mail.log /var/log/roundcube/errors.log
clear
sudo tail -f /var/log/mail.log /var/log/roundcube/errors.log
clear
sudo tail -f /var/log/mail.log /var/log/roundcube/errors.log
clear
sudo tail -f /var/log/mail.log /var/log/roundcube/errors.log
clear
sudo tail -f /var/log/mail.log /var/log/roundcube/errors.log
clear
sudo su - vmail -s /bin/bash
sudo chown -R vmail:basic /var/mail/vhosts/connectia.info/soporte/
sudo chmod -R 770 /var/mail/vhosts/connectia.info/soporte/
sudo systemctl start dovecot
sudo systemctl start postfix
clear
postqueue -p
tail -n 100 /var/log/mail.log
grep soporte@connectia.info /var/log/mail.log | tail -n 50
ls -l /var/mail/vhosts/connectia.info/soporte/
ls -l /var/mail/vhosts/connectia.info/soporte/Maildir/
quota -u vmail
sudo repquota -a | grep vmail
postfix flush
tail -n 50 /var/log/mail.log
tail -n 100 /var/log/mail.log
clear
systemctl status dovecot -l
tail -n 50 /var/log/dovecot.log
tail -n 50 /var/log/mail.log | grep dovecot
cat /etc/dovecot/conf.d/10-master.conf
cat /etc/dovecot/conf.d/15-lda.conf
cat /etc/dovecot/dovecot.conf
cat /etc/dovecot/conf.d/10-master.conf
clear
nano /etc/dovecot/dovecot-sql.conf.ext
cat /etc/dovecot/dovecot-sql.conf.ext
nano /etc/dovecot/dovecot-sql.conf.ext
clear
mysql -u pfadmin -pP4ssw0rdSeguro! -D postfixadmin -e "SHOW TABLES;"
mysql -u pfadmin -pP4ssw0rdSeguro! -D postfixadmin -e "SHOW CREATE TABLE mailbox\G"
mysql -u pfadmin -pP4ssw0rdSeguro! -D postfixadmin -e "DESCRIBE mailbox;"
mysql -u pfadmin -pP4ssw0rdSeguro! -D mailserver -e "SHOW TABLES;"
mysql -u pfadmin -pP4ssw0rdSeguro! -D mailserver -e "DESCRIBE mailbox;"
clear
nano /etc/dovecot/dovecot-sql.conf.ext
systemctl restart dovecot
clear
cat /etc/dovecot/conf.d/10-master.conf | grep -A 10 service\ lmtp
cat /etc/dovecot/conf.d/10-master.conf
nano /etc/dovecot/conf.d/10-master.conf
clear
systemctl restart dovecot
ls -l /var/spool/postfix/private/dovecot-lmtp
logrotate -f /etc/logrotate.d/dovecot
> /var/log/mail.log
> /var/log/dovecot.log
clear
logrotate -f /etc/logrotate.d/dovecot
> /var/log/mail.log
> /var/log/dovecot.log
tail -n 50 /var/log/mail.log | grep dovecot
tail -n 50 /var/log/dovecot.log
clear
nano /etc/dovecot/dovecot-sql.conf.ext
cat /etc/dovecot/dovecot-sql.conf.ext
cat /etc/dovecot/dovecot.conf
clear
nano /etc/dovecot/dovecot-sql.conf.ext
nano /etc/dovecot/dovecot.conf
systemctl restart dovecot
tail -n 50 /var/log/mail.log | grep dovecot
tail -n 50 /var/log/dovecot.log
clear
tail -f /var/log/mail.log
clear
systemctl restart dovecot
grep -r lmtp /etc/dovecot/conf.d/
clear
nano /etc/dovecot/conf.d/10-master.conf
systemctl restart dovecot
ls -l /var/spool/postfix/private/dovecot-lmtp
clear
tail -n 100 /var/log/mail.log
dig mx connectia.info +short
dig mail.connectia.info +short
ss -tlnp | grep :25
clear
cat  /etc/dovecot/conf.d/10-master.conf
nano /etc/dovecot/dovecot.conf
cat /etc/dovecot/dovecot.conf
systemctl restart dovecot
ls -l /var/spool/postfix/private/dovecot-lmtp
tail -n 50 /var/log/mail.log
tail -n 50 /var/log/dovecot.log
clear
nano /etc/dovecot/dovecot.conf
cat /etc/dovecot/dovecot.conf
systemctl restart dovecot
tail -n 50 /var/log/mail.log
tail -n 50 /var/log/dovecot.log
clear
root@vmi2599867:~# nano /etc/dovecot/dovecot.conf
root@vmi2599867:~# cat /etc/dovecot/dovecot.conf
#mail_location = maildir:~/
mail_location = maildir:/var/mail/vhosts/%d/%n
passdb {
}
userdb {
}
protocols = imap lmtp
service auth {
}
ssl = required
ssl_cert = </etc/letsencrypt/live/connectia.info/fullchain.pem
ssl_key = </etc/letsencrypt/live/connectia.info/privkey.pem
# Desactivar todos los plugins
mail_plugins = ""
root@vmi2599867:~# systemctl restart dovecot
root@vmi2599867:~# tail -n 50 /var/log/mail.log
tail -n 50 /var/log/dovecot.log
Jun 24 13:43:46 vmi2599867 postfix/qmgr[1294813]: 4A8D2280F15: from=<v-maojhn_pdojdhjapp_ifjcpaoc_ifjcpaoc_a@bounce.e.bancochile.cl>, size=100136, nrcpt=1 (queue active)
Jun 24 13:43:46 vmi2599867 postfix/qmgr[1294813]: 1C225280F20: from=<ndonoso.partner7@gmail.com>, size=3593, nrcpt=1 (queue active)
Jun 24 13:43:46 vmi2599867 postfix/lmtp[1349193]: 89BF7280F14: to=<mario.yanez@smartcalling.cl>, relay=none, delay=13021, delays=13021/0.04/0/0, dsn=4.4.1, status=deferred (connect to mail.connectia.info[private/dovecot-lmtp]: Connection refused)
Jun 24 13:43:46 vmi2599867 postfix/error[1349195]: 96E69280F04: to=<soporte@connectia.info>, relay=none, delay=50825, delays=50825/0.04/0/0, dsn=4.4.1, status=deferred (delivery temporarily suspended: connect to mail.connectia.info[private/dovecot-lmtp]: Connection refused)
Jun 24 13:43:47 vmi2599867 postfix/error[1349195]: 222FA280F0E: to=<soporte@connectia.info>, relay=none, delay=29717, delays=29716/1/0/0.01, dsn=4.4.1, status=deferred (delivery temporarily suspended: connect to mail.connectia.info[private/dovecot-lmtp]: Connection refused)
Jun 24 13:43:48 vmi2599867 postfix/error[1349195]: 4A8D2280F15: to=<mario.yanez@smartcalling.cl>, relay=none, delay=8881, delays=8879/2/0/0.01, dsn=4.4.1, status=deferred (delivery temporarily suspended: connect to mail.connectia.info[private/dovecot-lmtp]: Connection refused)
Jun 24 13:43:49 vmi2599867 postfix/error[1349195]: 1C225280F20: to=<soporte@connectia.info>, relay=none, delay=416, delays=413/3/0/0.01, dsn=4.4.1, status=deferred (delivery temporarily suspended: connect to mail.connectia.info[private/dovecot-lmtp]: Connection refused)
Jun 24 13:43:55 vmi2599867 dovecot: imap-login: Login: user=<soporte@connectia.info>, method=PLAIN, rip=209.145.49.68, lip=209.145.49.68, mpid=1349198, TLS, session=<mNbitVU4XL3RkTFE>
Jun 24 13:43:55 vmi2599867 dovecot: imap(soporte@connectia.info)<1349198><mNbitVU4XL3RkTFE>: Disconnected: Logged out in=50 out=563 deleted=0 expunged=0 trashed=0 hdr_count=0 hdr_bytes=0 body_count=0 body_bytes=0
Jun 24 13:44:01 vmi2599867 postfix/anvil[1294844]: statistics: max connection rate 1/60s for (submission:205.210.31.250) at Jun 24 13:34:03
Jun 24 13:44:01 vmi2599867 postfix/anvil[1294844]: statistics: max connection count 1 for (submission:205.210.31.250) at Jun 24 13:34:03
Jun 24 13:44:01 vmi2599867 postfix/anvil[1294844]: statistics: max message rate 1/60s for (smtp:209.85.167.51) at Jun 24 13:36:52
Jun 24 13:44:01 vmi2599867 postfix/anvil[1294844]: statistics: max recipient rate 1/60s for (smtp:209.85.167.51) at Jun 24 13:36:52
Jun 24 13:44:01 vmi2599867 postfix/anvil[1294844]: statistics: max cache size 4 at Jun 24 13:34:03
Jun 24 13:44:02 vmi2599867 postfix/smtpd[1349209]: warning: dict_nis_init: NIS domain name not set - NIS lookups disabled
Jun 24 13:44:02 vmi2599867 postfix/smtpd[1349209]: connect from mail-lf1-f52.google.com[209.85.167.52]
Jun 24 13:44:03 vmi2599867 postfix/smtpd[1349209]: Anonymous TLS connection established from mail-lf1-f52.google.com[209.85.167.52]: TLSv1.3 with cipher TLS_AES_128_GCM_SHA256 (128/128 bits) key-exchange X25519 server-signature RSA-PSS (2048 bits) server-digest SHA256
Jun 24 13:44:03 vmi2599867 postfix/smtpd[1349209]: 6285B280F1F: client=mail-lf1-f52.google.com[209.85.167.52]
Jun 24 13:44:03 vmi2599867 postfix/cleanup[1349210]: 6285B280F1F: message-id=<CANUKGOLyY2X6hN2ivT0SjGU3Y31eWj5BBUdkWD6h=8bbg1GYqQ@mail.gmail.com>
Jun 24 13:44:03 vmi2599867 postfix/qmgr[1294813]: 6285B280F1F: from=<ndonoso.partner7@gmail.com>, size=3186, nrcpt=1 (queue active)
Jun 24 13:44:03 vmi2599867 postfix/smtpd[1349213]: warning: dict_nis_init: NIS domain name not set - NIS lookups disabled
Jun 24 13:44:03 vmi2599867 postfix/smtpd[1349209]: disconnect from mail-lf1-f52.google.com[209.85.167.52] ehlo=2 starttls=1 mail=1 rcpt=1 bdat=1 quit=1 commands=7
Jun 24 13:44:03 vmi2599867 postfix/smtpd[1349213]: connect from localhost[127.0.0.1]
Jun 24 13:44:03 vmi2599867 postfix/smtpd[1349213]: 932E2280F22: client=localhost[127.0.0.1]
Jun 24 13:44:03 vmi2599867 postfix/cleanup[1349210]: 932E2280F22: message-id=<CANUKGOLyY2X6hN2ivT0SjGU3Y31eWj5BBUdkWD6h=8bbg1GYqQ@mail.gmail.com>
Jun 24 13:44:03 vmi2599867 opendkim[367011]: 932E2280F22: no signing table match for 'ndonoso.partner7@gmail.com'
Jun 24 13:44:03 vmi2599867 opendkim[367011]: 932E2280F22: DKIM verification successful
Jun 24 13:44:03 vmi2599867 opendkim[367011]: 932E2280F22: s=20230601 d=gmail.com a=rsa-sha256 SSL
Jun 24 13:44:03 vmi2599867 postfix/smtpd[1349213]: disconnect from localhost[127.0.0.1] ehlo=1 mail=1 rcpt=1 data=1 quit=1 commands=5
Jun 24 13:44:03 vmi2599867 postfix/qmgr[1294813]: 932E2280F22: from=<ndonoso.partner7@gmail.com>, size=3600, nrcpt=1 (queue active)
Jun 24 13:44:03 vmi2599867 amavis[1084797]: (1084797-18) Passed CLEAN {RelayedOpenRelay}, [209.85.167.52]:46332 [209.85.167.52] <ndonoso.partner7@gmail.com> -> <soporte@connectia.info>, Queue-ID: 6285B280F1F, Message-ID: <CANUKGOLyY2X6hN2ivT0SjGU3Y31eWj5BBUdkWD6h=8bbg1GYqQ@mail.gmail.com>, mail_id: 1uxYWRGZvLes, Hits: -, size: 3152, queued_as: 932E2280F22, dkim_sd=20230601:gmail.com, 197 ms
Jun 24 13:44:03 vmi2599867 postfix/lmtp[1349193]: 932E2280F22: to=<soporte@connectia.info>, relay=none, delay=0.05, delays=0.04/0.01/0/0, dsn=4.4.1, status=deferred (connect to mail.connectia.info[private/dovecot-lmtp]: Connection refused)
Jun 24 13:44:03 vmi2599867 postfix/smtp[1349211]: 6285B280F1F: to=<soporte@connectia.info>, relay=127.0.0.1[127.0.0.1]:10024, delay=0.35, delays=0.12/0.02/0.02/0.19, dsn=2.0.0, status=sent (250 2.0.0 from MTA(smtp:[127.0.0.1]:10025): 250 2.0.0 Ok: queued as 932E2280F22)
Jun 24 13:44:03 vmi2599867 postfix/qmgr[1294813]: 6285B280F1F: removed
Jun 24 13:44:08 vmi2599867 dovecot: imap-login: Login: user=<valentina.arriagada@fijodigital.cl>, method=PLAIN, rip=181.212.153.197, lip=209.145.49.68, mpid=1349221, TLS, session=<n36otlU4QsO11JnF>
Jun 24 13:44:08 vmi2599867 dovecot: imap-login: Login: user=<diego.yanez@fijodigital.cl>, method=PLAIN, rip=181.212.153.197, lip=209.145.49.68, mpid=1349224, TLS, session=<mOKotlU4RMO11JnF>
Jun 24 13:44:08 vmi2599867 dovecot: imap-login: Login: user=<ambar.monsalve@fijodigital.cl>, method=PLAIN, rip=181.212.153.197, lip=209.145.49.68, mpid=1349225, TLS, session=<i4iptlU4Q8O11JnF>
Jun 24 13:44:08 vmi2599867 dovecot: imap-login: Login: user=<hugo.herrera@fijodigital.cl>, method=PLAIN, rip=181.212.153.197, lip=209.145.49.68, mpid=1349227, TLS, session=<v/OqtlU4RcO11JnF>
Jun 24 13:44:08 vmi2599867 dovecot: imap-login: Login: user=<sebastian.saavedra@fijodigital.cl>, method=PLAIN, rip=181.212.153.197, lip=209.145.49.68, mpid=1349229, TLS, session=<MWKstlU4RsO11JnF>
Jun 24 13:44:08 vmi2599867 dovecot: imap-login: Login: user=<saida.velez@fijodigital.cl>, method=PLAIN, rip=181.212.153.197, lip=209.145.49.68, mpid=1349231, TLS, session=<CRqutlU4R8O11JnF>
Jun 24 13:44:08 vmi2599867 dovecot: imap-login: Login: user=<marcelo.avendano@fijodigital.cl>, method=PLAIN, rip=181.212.153.197, lip=209.145.49.68, mpid=1349236, TLS, session=<wcOxtlU4SMO11JnF>
Jun 24 13:44:08 vmi2599867 dovecot: imap-login: Login: user=<iris.llanos@fijodigital.cl>, method=PLAIN, rip=181.212.153.197, lip=209.145.49.68, mpid=1349237, TLS, session=<ZcSxtlU4ScO11JnF>
Jun 24 13:44:08 vmi2599867 dovecot: imap-login: Login: user=<danitza.toledo@fijodigital.cl>, method=PLAIN, rip=181.212.153.197, lip=209.145.49.68, mpid=1349239, TLS, session=<1SK0tlU4SsO11JnF>
Jun 24 13:44:09 vmi2599867 dovecot: imap-login: Login: user=<patricio.astudillo@fijodigital.cl>, method=PLAIN, rip=181.212.153.197, lip=209.145.49.68, mpid=1349240, TLS, session=<mLa0tlU4S8O11JnF>
Jun 24 13:44:09 vmi2599867 dovecot: imap-login: Login: user=<bryan.astudillo@fijodigital.cl>, method=PLAIN, rip=181.212.153.197, lip=209.145.49.68, mpid=1349241, TLS, session=<+re3tlU4TsO11JnF>
Jun 24 13:44:09 vmi2599867 dovecot: imap-login: Login: user=<agustin.donoso@fijodigital.cl>, method=PLAIN, rip=181.212.153.197, lip=209.145.49.68, mpid=1349243, TLS, session=</EO4tlU4TcO11JnF>
Jun 24 13:44:09 vmi2599867 dovecot: imap-login: Login: user=<maura.arrigada@fijodigital.cl>, method=PLAIN, rip=181.212.153.197, lip=209.145.49.68, mpid=1349244, TLS, session=<TUO4tlU4T8O11JnF>
Jun 24 13:44:09 vmi2599867 dovecot: imap-login: Login: user=<angelica.trujillo@fijodigital.cl>, method=PLAIN, rip=181.212.153.197, lip=209.145.49.68, mpid=1349245, TLS, session=<bVG4tlU4TMO11JnF>
Jun 24 13:44:09 vmi2599867 dovecot: imap-login: Login: user=<ximena.munoz@fijodigital.cl>, method=PLAIN, rip=181.212.153.197, lip=209.145.49.68, mpid=1349246, TLS, session=<KNe6tlU4UcO11JnF>
Jun 24 13:44:09 vmi2599867 dovecot: imap-login: Login: user=<jessica.meneses@fijodigital.cl>, method=PLAIN, rip=181.212.153.197, lip=209.145.49.68, mpid=1349247, TLS, session=<OTu9tlU4UsO11JnF>
root@vmi2599867:~#[3~clear
clear
ss -l | grep dovecot-lmtp
ls -l /var/spool/postfix/private/dovecot-lmtp
systemctl restart dovecot
journalctl -xe | grep dovecot
tail -n 100 /var/log/dovecot.log
cat /etc/dovecot/dovecot.conf
cat v
cat /etc/dovecot/conf.d/10-master.conf
clear
ps aux | grep dovecot
clear
cat /etc/dovecot/conf.d/10-lmtp.conf
nano cat /etc/dovecot/conf.d/10-lmtp.conf
clear
nano /etc/dovecot/conf.d/10-lmtp.conf
systemctl restart dovecot
ps aux | grep dovecot
ls -l /var/spool/postfix/private/dovecot-lmtp
journalctl -xe | grep dovecot
tail -n 50 /var/log/mail.log
clear
cat /etc/dovecot/dovecot.conf
journalctl -xe | grep dovecot
clear
cat /etc/dovecot/dovecot.conf
cat /etc/dovecot/conf.d/10-master.conf
cat /etc/dovecot/dovecot.conf
tail -n 50 /var/log/mail.log
clear
nano /etc/dovecot/conf.d/10-lmtp.conf
nano /etc/dovecot/conf.d/10-master.conf
systemctl restart dovecot
sleep 3
journalctl -u dovecot --no-pager | tail -n 40
clear
nano /etc/dovecot/conf.d/10-master.conf
systemctl restart dovecot
ps aux | grep lmtp
ls -l /var/spool/postfix/private/dovecot-lmtp
journalctl -u dovecot --no-pager | tail -n 40
clear
grep -i soporte@connectia.info /var/log/mail.log | tail -n 50
grep -Ei 'lmtp|soporte@connectia.info' /var/log/mail.log | tail -n 100
tail -n 100 /var/log/mail.log
clear
nano /etc/dovecot/conf.d/10-master.conf
ps aux | grep lmtp
ls -l /var/spool/postfix/private/dovecot-lmtp
systemctl restart dovecot
systemctl restart postfix
journalctl -u dovecot --no-pager | tail -n 40
clear
cat /etc/dovecot/conf.d/10-master.conf | grep -A 15 lmtp
netstat -anp | grep dovecot
ss -lpn | grep dovecot
clear
cat /etc/dovecot/dovecot.conf
nano /etc/dovecot/dovecot.conf
systemctl restart dovecot
ss -lpn | grep dovecot
clear
ls -l /var/spool/postfix/private/dovecot-lmtp
postqueue -p
grep -i lmtp /var/log/mail.log | tail -n 30
clear
ss -lpn | grep lmtp
nano /etc/dovecot/conf.d/10-master.conf
cat /etc/dovecot/conf.d/10-master.conf
clear
ls -ld /var/spool/postfix/private
ls -l /var/spool/postfix/private/
cat /etc/dovecot/dovecot.conf
systemctl restart dovecot
sleep 2
journalctl -u dovecot --no-pager | tail -n 50
grep -ri lmtp /etc/dovecot/conf.d/
grep -ri dovecot-lmtp /etc/dovecot/conf.d/
clear
ls -l /usr/lib/dovecot/lmtp
ps aux | grep lmtp
systemctl restart dovecot
sleep 2
journalctl -u dovecot --no-pager | grep -i error | tail -n 40
journalctl -u dovecot --no-pager | grep -i lmtp | tail -n 40
clear
nano /etc/dovecot/conf.d/10-master.conf
usermod -a -G postfix vmail
usermod -a -G vmail postfix
rm /var/spool/postfix/private/dovecot-lmtp
systemctl restart dovecot postfix
ss -lpn | grep lmtp
ls -l /var/spool/postfix/private/
ps aux | grep lmtp
journalctl -u dovecot --no-pager | tail -n 30
clear
postqueue -f
rm /var/spool/postfix/private/dovecot-lmtp
rm /var/spool/postfix/private/lmtp
systemctl restart dovecot postfix
ss -lpn | grep dovecot
ss -lpn | grep lmtp
ls -l /var/spool/postfix/private/
postqueue -f
ss -lpn | grep lmtp
ls -l /var/spool/postfix/private/
clear
nano /etc/dovecot/conf.d/10-master.conf
cat /etc/dovecot/conf.d/10-master.conf
rm -f /var/spool/postfix/private/lmtp
rm -f /var/spool/postfix/private/dovecot-lmtp
systemctl restart dovecot
sleep 2
ls -l /var/spool/postfix/private/
ss -lpn | grep dovecot
ss -lpn | grep lmtp
systemctl restart postfix
postqueue -f
clear
aa-status
getenforce
journalctl -u dovecot --no-pager | tail -n 40
tail -n 40 /var/log/mail.log
ps aux | grep dovecot
chgrp vmail /var/spool/postfix/private
chmod 770 /var/spool/postfix/private
grep -ri lmtp /etc/dovecot/
clear
nano /etc/dovecot/conf.d/10-lmtp.conf
rm -f /var/spool/postfix/private/dovecot-lmtp
systemctl restart dovecot
sleep 2
ls -l /var/spool/postfix/private/
ps aux | grep lmtp
clear
nano root@vmi2599867:~# nano /etc/dovecot/conf.d/10-lmtp.conf
root@vmi2599867:~# rm -f /var/spool/postfix/private/dovecot-lmtp
systemctl restart dovecot
sleep 2
ls -l /var/spool/postfix/private/
total 0
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 amavis
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 anvil
srw-rw---- 1 postfix postfix 0 Jun 24 14:08 auth
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 bounce
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 bsmtp
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 defer
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 discard
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 error
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 ifmail
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 lmtp
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 local
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 maildrop
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 mailman
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 policy
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 proxymap
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 proxywrite
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 relay
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 retry
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 rewrite
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 scache
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 scalemail-backend
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 smtp
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 smtpd
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 tlsmgr
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 trace
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 uucp
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 verify
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 virtual
root@vmi2599867:~# ls -l /var/spool/postfix/private/
total 0
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 amavis
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 anvil
srw-rw---- 1 postfix postfix 0 Jun 24 14:08 auth
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 bounce
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 bsmtp
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 defer
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 discard
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 error
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 ifmail
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 lmtp
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 local
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 maildrop
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 mailman
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 policy
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 proxymap
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 proxywrite
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 relay
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 retry
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 rewrite
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 scache
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 scalemail-backend
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 smtp
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 smtpd
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 tlsmgr
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 trace
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 uucp
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 verify
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:29 virtual
root@vmi2599867:~# ps aux | grep lmtp
root     1353856  0.0  0.0   9080  2224 pts/0    S+   14:35   0:00 grep --color=auto lmtp
root@vmi2599867:~#
clear
nano /etc/dovecot/conf.d/10-master.conf
systemctl restart dovecot
sleep 2
ls -l /var/spool/postfix/private/
grep -r 'service lmtp' /etc/dovecot/
grep -r 'unix_listener' /etc/dovecot/
clear
nano /etc/dovecot/conf.d/10-master.conf
systemctl restart dovecot
ls -l /var/spool/postfix/private/
postqueue -f
tail -n 40 /var/log/mail.log
clear
nano /etc/postfix/main.cf
cat /etc/postfix/main.cf
clear
grep ^protocols /etc/dovecot/dovecot.conf
nano /etc/dovecot/conf.d/10-master.conf
rm -f /var/spool/postfix/private/dovecot-lmtp
rm -f /var/spool/postfix/private/lmtp
systemctl restart dovecot
systemctl restart postfix
ls -l /var/spool/postfix/private/
journalctl -u dovecot -n 50 --no-pager
dovecot -n
clear
cat /etc/dovecot/conf.d/10-master.conf
ls -ld /var/spool/postfix/private
ls -ld /var/spool/postfix
ls -ld /var/spool/postfix/private
ls -ld /var/spool/postfix
chown postfix:postfix /var/spool/postfix/private
chmod 770 /var/spool/postfix/private
journalctl -fu dovecot
clear
cat /etc/dovecot/conf.d/10-lmtp.conf
ps aux | grep lmtp
doveadm log debug
systemctl restart dovecot
journalctl -u dovecot -n 50 --no-pager
dovecot -n
dovecot -a
clear
nano /etc/dovecot/conf.d/10-master.conf
systemctl restart dovecot
ls -l /var/spool/postfix/private/dovecot-lmtp
dovecot -n
journalctl -u dovecot -n 50 --no-pager
clear
ps aux | grep lmtp
journalctl -u dovecot -n 50 --no-pager
tail -n 100 /var/log/dovecot.log
cat /etc/dovecot/conf.d/10-master.conf
systemctl stop dovecot
sleep 3
systemctl start dovecot
journalctl -u dovecot -n 30 --no-pager
systemctl stop dovecot
dovecot -F
systemctl stop dovecot
sleep 3
systemctl start dovecot
journalctl -u dovecot -n 30 --no-pager
clear
doveconf protocols
doveconf service/lmtp
grep -ir lmtp /etc/dovecot/
ls -ld /var/spool/postfix/private
ls -ld /var/spool/postfix
systemctl stop dovecot
dovecot -F -D
clear
dovecot -F
clear
postconf -n | grep lmtp
tail -n 50 /var/log/mail.log | grep -i error
tail -n 50 /var/log/mail.log | grep -i lmtp
cat /etc/postfix/master.cf
cat /etc/postfix/main.cf | grep -v '^#' | grep -v '^$'
clear
ls -ld /var/spool/postfix/private
ls -ld /var/spool/postfix
ps aux | grep dovecot
getent passwd dovecot
getent passwd vmail
clear
systemctl start dovecot
sleep 2
systemctl status dovecot
ps aux | grep dovecot
ls -l /var/spool/postfix/private/
clear
root@vmi2599867:~# systemctl start dovecot
sleep 2
systemctl status dovecot
ps aux | grep dovecot
● dovecot.service - Dovecot IMAP/POP3 email server
Jun 24 15:39:38 vmi2599867.contaboserver.net systemd[1]: Starting Dovecot IMAP/POP3 email server...
Jun 24 15:39:38 vmi2599867.contaboserver.net dovecot[1358068]: master: Dovecot v2.3.16 (7e2e900c1a) starting up for imap, lmtp (core dumps disabled)
Jun 24 15:39:38 vmi2599867.contaboserver.net systemd[1]: Started Dovecot IMAP/POP3 email server.
root     1358068  1.5  0.0   8276  3932 ?        Ss   15:39   0:00 /usr/sbin/dovecot -F
dovecot  1358069  0.0  0.0   4664  1428 ?        S    15:39   0:00 dovecot/anvil
root     1358070  0.0  0.0   4804  2940 ?        S    15:39   0:00 dovecot/log
root     1358071  0.0  0.0   6276  3628 ?        S    15:39   0:00 dovecot/config
root     1358076  0.0  0.0   9080  2120 pts/0    S+   15:39   0:00 grep --color=auto dovecot
root@vmi2599867:~# ls -l /var/spool/postfix/private/
total 0
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 amavis
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 anvil
srw-rw---- 1 postfix postfix 0 Jun 24 14:08 auth
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 bounce
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 bsmtp
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 defer
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 discard
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 error
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 ifmail
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 lmtp
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 local
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 maildrop
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 mailman
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 policy
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 proxymap
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 proxywrite
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 relay
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 retry
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 rewrite
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 scache
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 scalemail-backend
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 smtp
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 smtpd
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 tlsmgr
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 trace
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 uucp
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 verify
srw-rw-rw- 1 postfix postfix 0 Jun 24 14:45 virtual
root@vmi2599867:~#
clear
dovecot -n
dovecot -a
journalctl -u dovecot -n 50 --no-pager
clear
nano /etc/dovecot/conf.d/10-master.conf
doveconf -n | grep -A 5 lmtp
doveconf -a
clear
which dovecot
whereis dovecot
dpkg -l | grep dovecot
find / -type f -name 'dovecot*' 2>/dev/null | grep -E 'bin|sbin'
find /etc -type d -name 'dovecot*'
find / -type d -name 'dovecot*' 2>/dev/null | grep -v /proc | grep -v /run
ps aux | grep -i dovecot
find / -type s -name '*dovecot*' 2>/dev/null
clear
/etc/dovecot/conf.d/10-master.conf
clear
cat <<'OEF' > /etc/dovecot/conf.d/10-master.conf
##
## Dovecot Master configuration file - SOLO BLOQUE NECESARIO
##

service lmtp {
  unix_listener /var/spool/postfix/private/dovecot-lmtp {
    mode = 0600
    user = postfix
    group = postfix
  }
}
OEF

systemctl restart dovecot
ls -l /var/spool/postfix/private/dovecot-lmtp
clear
zcat /usr/share/doc/dovecot-core/examples/10-master.conf.gz > /etc/dovecot/conf.d/10-master.conf
cp /usr/share/dovecot/example-config/conf.d/10-master.conf /etc/dovecot/conf.d/10-master.conf
nano /usr/share/doc/dovecot-core/examples/10-master.conf
sed -i '/service lmtp {/,/^}/d' /etc/dovecot/conf.d/10-master.conf
cat <<'EOF' >> /etc/dovecot/conf.d/10-master.conf

service lmtp {
  unix_listener /var/spool/postfix/private/dovecot-lmtp {
    mode = 0600
    user = postfix
    group = postfix
  }
}
EOF

systemctl restart dovecot
ls -l /var/spool/postfix/private/dovecot-lmtp
clear
nano /etc/dovecot/conf.d/10-master.conf
systemctl restart dovecot
ls -l /var/spool/postfix/private/dovecot-lmtp
doveconf protocols
cat /etc/dovecot/conf.d/10-master.conf
ls -ld /var/spool/postfix/private
ls -ld /var/spool/postfix
systemctl restart dovecot
sleep 2
journalctl -u dovecot -n 50 --no-pager
ps aux | grep lmtp
clear
ls -ld /var/spool/postfix/private
nano /etc/dovecot/conf.d/20-lmtp.conf
dovecot -F
root@vmi2599867:~# ls -ld /var/spool/postfix/private
drwxrwx--- 2 postfix postfix 4096 Jun 24 14:45 /var/spool/postfix/private
root@vmi2599867:~# nano /etc/dovecot/conf.d/20-lmtp.conf
root@vmi2599867:~# dovecot -F
Fatal: Dovecot is already running with PID 1360293 (read from /run/dovecot/master.pid)
root@vmi2599867:~#
clear
systemctl stop dovecot
sleep 2
ps aux | grep -i dovecot
kill -9 <1360654>
clear
root@vmi2599867:~# systemctl stop dovecot
sleep 2
ps aux | grep -i dovecot
root     1360654  0.0  0.0   9212  2244 pts/0    S+   16:15   0:00 grep --color=auto -i dovecot
root@vmi2599867:~# kill -9 <1360654>
-bash: syntax error near unexpected token `1360654'
root@vmi2599867:~#
clear
dovecot -F
journalctl -fu dovecot
clear
apt-get update
apt-get install --reinstall dovecot-lmtpd
systemctl restart dovecot
sleep 2
journalctl -u dovecot -n 50 --no-pager
ls -l /var/spool/postfix/private/
clear
nano /etc/dovecot/conf.d/10-master.conf
systemctl restart dovecot
sleep 2
journalctl -u dovecot -n 50 --no-pager
ls -l /var/spool/postfix/private/
id vmail
clear
grep -B2 dovecot-lmtp /etc/dovecot/conf.d/10-master.conf
doveconf | grep dovecot-lmtp
ls -ld /var/spool/postfix/private
ls -ld /var/spool/postfix
grep -i lmtp /etc/dovecot/conf.d/*.conf
rm -f /var/spool/postfix/private/dovecot-lmtp
clear
cat /etc/dovecot/conf.d/10-lmtp.conf
cat /etc/dovecot/conf.d/20-lmtp.conf
nano /etc/dovecot/conf.d/10-lmtp.conf
> /etc/dovecot/conf.d/10-lmtp.conf
systemctl restart dovecot
sleep 2
ls -l /var/spool/postfix/private/
doveconf | grep dovecot-lmtp
cat /etc/dovecot/conf.d/10-master.conf
clear
cd /etc/
ls -lt
cd roundcube
ls -lt
nano config.inc.php
cd ..
cd dovecot
ls -lt
cat conf.d
car dovecot.conf
cat dovecot.conf
cat dovecot-sql.conf.ext
cd conf.d
ls -lt
cat 10-lmtp.conf
cat 10-master.conf
cat 20.lmtp.conf
cat 20-lmtop.conf
cat 20-lmtp.conf
cat 10-auth.conf
cat 10-mail.conf
cd ..
ls -lt
cd ..
clear
cd dovecot
ls -lt
cd conf.d
ls -lt
cd ..
cd postfix
ls -lt
cat main.cf
cat master.cf
clear
cd ..
cd /var/www/
ls -lt
cd ..
ls -lt
cd www
cd posdtfixadmin
cd postfixadmin
ls -lt
cd /var/spool/postfix/private/
ls -lt
clear
cd ..
cd..
cd ..
clear
doveadm service status lmtp
journalctl -u dovecot -n 40 --no-pager
clear
nano /etc/dovecot/conf.d/10-master.conf
systemctl restart dovecot
sleep 2
ls -l /var/spool/postfix/private/
doveadm service status lmtp
dovecot --version
lsb_release -a
uname -a
reboot
clear
ls -l /var/spool/postfix/private/
doveadm service stop lmtp
doveadm service start lmtp
systemctl restart dovecot
ls -l /var/spool/postfix/private/
clear
nano /etc/dovecot/conf.d/10-master.conf
cat /etc/dovecot/conf.d/10-master.conf
nano /etc/dovecot/conf.d/10-lmtp.conf
mv /etc/dovecot/conf.d/20-lmtp.conf /etc/dovecot/conf.d/20-lmtp.conf.bak
systemctl status dovecot
ls -l /var/spool/postfix/private/
doveadm service status lmtp
journalctl -u dovecot -n 50 --no-pager
clear
tail -n 50 /var/log/mail.log
clear
tail -n 100 /var/log/mail.log
clear
ls -l /var/spool/postfix/private/auth
nano /etc/dovecot/conf.d/10-master.conf
systemctl restart dovecot
systemctl restart postfix
ls -l /var/spool/postfix/private/auth
tail -n 50 /var/log/mail.log
clear
systemctl restart dovecot
sleep 1
ls -l /var/spool/postfix/private/auth
tail -n 50 /var/log/mail.log
apt-get install dovecot-sieve dovecot-managesieved
apt-get install libsasl2-modules
cat /var/log/roundcube/errors.log | tail -n 30
ss -pl | grep dovecot
clear
systemctl stop dovecot
ps aux | grep dovecot
rm -f /var/spool/postfix/private/auth
ls -ld /var/spool/postfix/private/
ls -ld /var/spool/postfix/
systemctl start dovecot
ls -l /var/spool/postfix/private/auth
systemctl restart postfix
clear
ls -l /var/www/
ls -l /var/www/html/
ls -l /var/www/roundcube/skins/
ls -l /var/www/roundcube/skins/elastic/
ls -l /var/www/html/roundcube/skins/
ls -l /var/www/html/roundcube/skins/elastic/
ls -l /var/www/roundcube/skins/elastic/images/
ls -l /var/www/html/roundcube/skins/elastic/images/
ls -l /var/www/roundcube/skins/elastic/config.inc.php
ls -l /var/www/roundcube/skins/elastic/includes/head.html
ls -l /var/www/html/roundcube/skins/elastic/config.inc.php
ls -l /var/www/html/roundcube/skins/elastic/includes/head.html
find /var/www/ -type d -name "roundcube"
find /var/www/ -iname "*logo*"
clear
find / -name index.php 2>/dev/null | grep roundcube
find / -type d -iname "skins"
find / -type d -iname "elastic"
find / -type d -iname "*roundcube*"
ls -l /usr/share/roundcube/
ls -l /usr/share/roundcube/skins/elastic/
grep -Ri roundcube /etc/apache2/sites-available/
grep -Ri roundcube /etc/nginx/sites-available/
clear
cp /var/www/mailpanel/public/images/logo-connectia.png /usr/share/roundcube/skins/elastic/images/logo-connectia.png
chown www-data:www-data /usr/share/roundcube/skins/elastic/images/logo-connectia.png
nano /usr/share/roundcube/skins/elastic/config.inc.php
mv /usr/share/roundcube/skins/elastic/images/favicon.ico /usr/share/roundcube/skins/elastic/images/favicon-original.ico 2>/dev/null
cp /var/www/mailpanel/public/images/logo-connectia.png /usr/share/roundcube/skins/elastic/images/favicon.ico
chown www-data:www-data /usr/share/roundcube/skins/elastic/images/favicon.ico
nano /usr/share/roundcube/skins/elastic/templates/login.html
cat /usr/share/roundcube/skins/elastic/templates/login.html
clear
nano /usr/share/roundcube/skins/elastic/templates/login.html
nano /usr/share/roundcube/skins/elastic/includes/header.html
nano /usr/share/roundcube/skins/elastic/includes/layout.html
nano nano /usr/share/roundcube/skins/elastic/includes/layout.html
nano /usr/share/roundcube/skins/elastic/templates/mail.html
cat /usr/share/roundcube/skins/elastic/templates/mail.html
clear
nano /usr/share/roundcube/skins/elastic/templates/mail.html
cp /usr/share/roundcube/skins/elastic/templates/mail.html /usr/share/roundcube/skins/elastic/templates/mail.html.bak
nano /usr/share/roundcube/skins/elastic/templates/mail.html
clear
nano /usr/share/roundcube/skins/elastic/styles/styles.css
ls /usr/share/roundcube/skins/elastic/styles/
clear
root@vmi2599867:~# ls /usr/share/roundcube/skins/elastic/styles/
colors.less  embed.min.css     layout.less  print.min.css   variables.less
dark.less    fontawesome.less  mixins.less  styles.less     widgets
embed.less   global.less       print.less   styles.min.css
root@vmi2599867:~#
clear
nano /usr/share/roundcube/skins/elastic/styles/styles.min.css
nano /usr/share/roundcube/skins/elastic/styles/styles.less
cat  /usr/share/roundcube/skins/elastic/styles/styles.less
clear
cp /usr/share/roundcube/skins/elastic/styles/styles.min.css /usr/share/roundcube/skins/elastic/styles/styles.min.css.bak
ls -l /usr/share/roundcube/skins/elastic/images/logo-connectia.png
sed -i 's|background-image:url(../images/logo.svg);|background-image:url(../images/logo-connectia.png);|g' /usr/share/roundcube/skins/elastic/styles/styles.min.css
clear
nano /etc/dovecot/conf.d/10-master.conf
systemctl restart dovecot
tail -n 30 /var/log/mail.log
tail -n 30 /var/log/mail.err
ls -l /var/spool/postfix/private/auth
cat /etc/dovecot/conf.d/10-master.conf
clear
ls -ld /var/spool/postfix/
ls -ld /var/spool/postfix/private/
systemctl stop dovecot
systemctl start dovecot
journalctl -xeu dovecot | tail -n 60
ss -l | grep auth
getent passwd vmail
systemctl restart dovecot
systemctl restart postfix
sleep 2
ls -l /var/spool/postfix/private/auth
clear
cat /etc/dovecot/conf.d/10-master.conf
cat /etc/dovecot/dovecot.conf
clear
nano /etc/dovecot/dovecot.conf
systemctl restart dovecot
ls -l /var/spool/postfix/private/auth
tail -n 40 /var/log/mail.log
clear
tail -n 40 /var/log/mail.log
clear
tail -n 40 /var/log/mail.log
clear
find /var/www/ -iname '*logo*'
/var/www/mailpanel/public/images/logo-connectia.png
clear
cp /var/www/mailpanel/public/images/logo-connectia.png /var/www/roundcube/skins/elastic/images/logo-connectia.png
nano /var/www/roundcube/skins/elastic/config.inc.php
cp /var/www/mailpanel/public/images/logo-connectia.png /var/www/roundcube/skins/elastic/images/favicon.ico
nano /var/www/roundcube/skins/elastic/includes/head.html
clear
cat /etc/roundcube/config.inc.php | grep skin
cat /usr/share/roundcube/config/config.inc.php | grep skin
ls -lh /usr/share/roundcube/skins/elastic/images/
grep -ri logo /usr/share/roundcube/skins/elastic/
clear
nano /usr/share/roundcube/skins/elastic/watermark.html
nano /usr/share/roundcube/skins/elastic/templates/includes/menu.html
clear
nano /usr/share/roundcube/skins/elastic/templates/login.html
cat  /usr/share/roundcube/skins/elastic/templates/login.html
nano /usr/share/roundcube/skins/elastic/templates/login.html
clear
sudo grep -Rni 'panel.connectia.info' /etc /var /usr /home /opt /srv 2>/dev/null
clear
cp /var/www/html/assets/favicon.png /var/www/html/favicon.png
cd /var/www/html/assets/
ls -lt
cd logos
ls -lt
cp /var/www/html/assets/logos/favicon.png /var/www/html/favicon.png
nano /var/www/html/index.html
cat /var/www/html/index.html
root@vmi2599867:/var/www/html/assets/logos# cat
clear
cat /var/www/html/index.html
clear
cp /var/www/html/assets/logos/favicon.png /var/www/html/favicon.png
nano /var/www/html/index.html
clear
cd ~
rm -rf mailcow-dockerized
git clone https://github.com/mailcow/mailcow-dockerized
cd mailcow-dockerized
./generate_config.sh
clear
# Instala los paquetes necesarios
apt update
apt install -y apt-transport-https ca-certificates curl software-properties-common gnupg lsb-release
# Agrega el repositorio oficial de Docker
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
echo   "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu \
  $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
# Instala Docker y Docker Compose plugin
apt update
apt install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
# Habilita e inicia el servicio Docker
systemctl enable docker
systemctl start docker
docker --version
docker compose version
cd ~/mailcow-dockerized
./generate_config.sh
clear
docker compose pull
docker compose up -d
clear
ss -tulnp | grep :143
netstat -tulnp | grep :143
clear
systemctl stop dovecot
systemctl disable dovecot
docker compose up -d
ss -tulnp | grep :143
clear
ss -tulnp | grep :25
lsof -i :25
clear
systemctl stop postfix
systemctl disable postfix
ss -tulnp | grep :25
docker compose up -d
docker compose ps
clear
ss -tulnp | grep :80
lsof -i :80
systemctl stop apache2
systemctl disable apache2
ss -tulnp | grep :80
docker compose up -d
docker compose ps
clear
docker compose exec mysql-mailcow mysql -u mailcow -p$(grep DBPASS= mailcow.conf | cut -d'=' -f2) mailcow
docker compose exec mailcow-mailcow /reset_admin_password.sh
docker compose exec php-fpm-mailcow /reset_admin_password.sh
clear
date
docker compose exec php-fpm-mailcow bash
php -r "echo password_hash('Soyelniko1', PASSWORD_BCRYPT) . PHP_EOL;"
docker compose exec mysql-mailcow mysql -u mailcow -p$(grep DBPASS= mailcow.conf | cut -d'=' -f2) mailcow
docker compose restart php-fpm-mailcow nginx-mailcow
date
docker compose logs php-fpm-mailcow | tail -30
docker compose logs nginx-mailcow | tail -30
clear
docker compose ps
ss -tulnp | grep -E ':80|:443'
clear
ufw status
ufw allow 80/tcp
ufw allow 443/tcp
ufw reload
curl -vk http://localhost
curl -vk http://127.0.0.1
curl -vk https://localhost --insecure
clear
root@vmi2599867:~/mailcow-dockerized# ufw status
Status: active
To                         Action      From
--                         ------      ----
22/tcp                     ALLOW       Anywhere
25/tcp                     ALLOW       Anywhere
587/tcp                    ALLOW       Anywhere
993/tcp                    ALLOW       Anywhere
995/tcp                    ALLOW       Anywhere
80/tcp                     ALLOW       Anywhere
443/tcp                    ALLOW       Anywhere
8080/tcp                   ALLOW       Anywhere
22/tcp (v6)                ALLOW       Anywhere (v6)
25/tcp (v6)                ALLOW       Anywhere (v6)
587/tcp (v6)               ALLOW       Anywhere (v6)
993/tcp (v6)               ALLOW       Anywhere (v6)
995/tcp (v6)               ALLOW       Anywhere (v6)
80/tcp (v6)                ALLOW       Anywhere (v6)
443/tcp (v6)               ALLOW       Anywhere (v6)
8080/tcp (v6)              ALLOW       Anywhere (v6)
root@vmi2599867:~/mailcow-dockerized# ufw allow 80/tcp
ufw allow 443/tcp
ufw reload
Skipping adding existing rule
Skipping adding existing rule (v6)
Skipping adding existing rule
Skipping adding existing rule (v6)
Firewall reloaded
clear
curl -I http://localhost
curl -I http://127.0.0.1
curl -I https://localhost --insecure
clear
docker compose exec mysql-mailcow mysql -u mailcow -p$(grep DBPASS= mailcow.conf | cut -d'=' -f2) mailcow
clea
clear
docker compose exec php-fpm-mailcow php -r "echo password_hash('Soyelniko1', PASSWORD_BCRYPT) . PHP_EOL;"
docker compose exec mysql-mailcow mysql -u mailcow -p$(grep DBPASS= mailcow.conf | cut -d'=' -f2) mailcow
docker compose restart php-fpm-mailcow nginx-mailcow
docker compose exec mysql-mailcow mysql -u mailcow -p$(grep DBPASS= mailcow.conf | cut -d'=' -f2) mailcow -e "SELECT * FROM admin;"
clear
sudo systemctl status postfix
sudo systemctl status dovecot
sudo cat /etc/postfix/main.cf | grep ssl
sudo cat /etc/dovecot/dovecot.conf | grep ssl
dig MX connectia.info
dig MX smartcalling.cl
dig MX fijodigital.cl
dig TXT connectia.info
dig TXT smartcalling.cl
dig TXT fijodigital.cl
openssl s_client -connect mail.connectia.info:443
clear
sudo systemctl start postfix
sudo systemctl start dovecot
sudo systemctl status postfix
sudo systemctl status dovecot
clear
sudo lsof -i :143
sudo lsof -i :993
sudo docker ps
clear
sudo docker stop mailcowdockerized-dovecot-mailcow-1
sudo systemctl restart dovecot
sudo systemctl restart postfix
sudo systemctl status dovecot
sudo systemctl status postfix
clear
sudo nano /etc/dovecot/dovecot.conf
cat /etc/dovecot/dovecot.conf
cat /etc/postfix/main.cf
openssl s_client -connect mail.connectia.info:443
clear
sudo docker ps
sudo docker stop mailcowdockerized-dovecot-mailcow-1
sudo docker stop mailcowdockerized-postfix-mailcow-1
sudo docker-compose restart
openssl s_client -connect mail.connectia.info:443
clear
sudo docker stop mailcowdockerized-dovecot-mailcow-1
sudo docker stop mailcowdockerized-postfix-mailcow-1
sudo nano /opt/mailcow-dockerized/docker-compose.yml
clear
sudo find / -name "docker-compose.yml" 2>/dev/null
sudo nano /root/mailcow-dockerized/docker-compose.yml
cat /root/mailcow-dockerized/docker-compose.yml
clear
sudo cp /etc/letsencrypt/live/connectia.info/fullchain.pem /root/mailcow-dockerized/data/assets/ssl/
sudo cp /etc/letsencrypt/live/connectia.info/privkey.pem /root/mailcow-dockerized/data/assets/ssl/
cd /root/mailcow-dockerized/
sudo docker-compose down  # Detener los contenedores de Mailcow
sudo docker-compose up -d  # Iniciar los contenedores nuevamente con la configuración actual
openssl s_client -connect mail.connectia.info:443
clear
sudo cp /etc/letsencrypt/live/connectia.info/fullchain.pem /root/mailcow-dockerized/data/assets/ssl/
sudo cp /etc/letsencrypt/live/connectia.info/privkey.pem /root/mailcow-dockerized/data/assets/ssl/
sudo nano /root/mailcow-dockerized/docker-compose.yml
clear
sudo docker ps
clear
# Reiniciar el contenedor de nginx
sudo docker restart mailcowdockerized-nginx-mailcow-1
openssl s_client -connect mail.connectia.info:443
cat /root/mailcow-dockerized/data/conf/nginx/mailcow-nginx.conf
clear
sudo ls /root/mailcow-dockerized/data/conf/nginx/
clear
cat /root/mailcow-dockerized/data/conf/nginx/listen_ssl.active
cat /root/mailcow-dockerized/data/conf/nginx/listen_plain.active
ls /root/mailcow-dockerized/data/conf/nginx/templates/
sudo nano /root/mailcow-dockerized/data/conf/nginx/listen_ssl.active
sudo nano /root/mailcow-dockerized/data/conf/nginx/listen_plain.active
cat /root/mailcow-dockerized/data/conf/nginx/templates/nginx.conf.j2
cat /root/mailcow-dockerized/data/conf/nginx/templates/sites-default.conf.j2
sudo docker restart mailcowdockerized-nginx-mailcow-1
openssl s_client -connect mail.connectia.info:443
clear
sudo cp /etc/letsencrypt/live/connectia.info/fullchain.pem /etc/ssl/mail/cert.pem
sudo cp /etc/letsencrypt/live/connectia.info/privkey.pem /etc/ssl/mail/key.pem
ls -l /etc/ssl/mail/
clear
sudo ls -l /etc/letsencrypt/live/connectia.info/
sudo nano /root/mailcow-dockerized/data/conf/nginx/templates/nginx.conf.j2
cat /root/mailcow-dockerized/data/conf/nginx/templates/nginx.conf.j2
sudo docker exec -it mailcowdockerized-nginx-mailcow-1 cat /etc/nginx/nginx.conf
sudo docker logs mailcowdockerized-nginx-mailcow-1
clear
sudo ls -l /etc/letsencrypt/live/connectia.info/
cat /root/mailcow-dockerized/data/conf/nginx/templates/nginx.conf.j2
sudo docker exec -it mailcowdockerized-nginx-mailcow-1 cat /etc/nginx/nginx.conf
clear
sudo mkdir -p /etc/ssl/mail/
sudo cp /etc/letsencrypt/live/connectia.info/fullchain.pem /etc/ssl/mail/cert.pem
sudo cp /etc/letsencrypt/live/connectia.info/privkey.pem /etc/ssl/mail/key.pem
sudo chmod 755 /etc/ssl/mail/
sudo chmod 644 /etc/ssl/mail/*
sudo docker restart mailcowdockerized-nginx-mailcow-1
openssl s_client -connect mail.connectia.info:443
clear
sudo docker exec -it mailcowdockerized-nginx-mailcow-1 /bin/bash
ls -l /etc/ssl/mail/
sudo docker cp /etc/ssl/mail/cert.pem mailcowdockerized-nginx-mailcow-1:/etc/ssl/mail/cert.pem
sudo docker cp /etc/ssl/mail/key.pem mailcowdockerized-nginx-mailcow-1:/etc/ssl/mail/key.pem
sudo docker restart mailcowdockerized-nginx-mailcow-1
clear
sudo nano /root/mailcow-dockerized/docker-compose.yml
cat /root/mailcow-dockerized/docker-compose.yml
clear
sudo sed -i 's|./data/assets/ssl:/etc/ssl/mail/:ro,z|./data/assets/ssl:/etc/ssl/mail/:rw,z|' /root/mailcow-dockerized/docker-compose.yml
sudo docker-compose down
sudo docker-compose up -d
sudo /usr/local/bin/docker-compose down
sudo /usr/local/bin/docker-compose up -d
sudo docker restart mailcowdockerized-nginx-mailcow-1
openssl s_client -connect mail.connectia.info:443
clear
sudo curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
docker-compose --version
sudo docker-compose down
sudo docker-compose up -d
clear
sudo sed -i 's|^\s*-\s"\${HTTPS_BIND:-}:\${HTTPS_PORT:-443}:\${HTTPS_PORT:-443}"|\s*-\s"80:80"\n\s*-\s"443:443"|g' /root/mailcow-dockerized/docker-compose.yml
sudo docker-compose down
sudo docker-compose up -d
cat /root/mailcow-dockerized/docker-compose.yml
clear
sudo sed -i 's|^\s*-\s*"\${HTTPS_BIND:-}:\${HTTPS_PORT:-443}:\${HTTPS_PORT:-443}"|    - "80:80"\n    - "443:443"|g' /root/mailcow-dockerized/docker-compose.yml
sudo docker-compose down
sudo docker-compose up -d
clear
sudo nano /root/mailcow-dockerized/docker-compose.yml
cat /root/mailcow-dockerized/docker-compose.yml
sudo docker-compose down
sudo docker-compose up -d
clear
sudo nano /root/mailcow-dockerized/docker-compose.yml
sudo docker-compose down
sudo docker-compose up -d
sudo nano /root/mailcow-dockerized/docker-compose.yml
sudo docker-compose down
sudo docker-compose up -d
CLEAR
clear
sudo lsof -i :143
sudo systemctl stop <nombre-del-servicio>
sudo docker ps  # Para ver los contenedores activos
sudo docker stop <container-id>  # Detener el contenedor usando su ID
clear
sudo systemctl stop dovecot
sudo systemctl list-units --type=service | grep dovecot
sudo lsof -i :143
sudo docker-compose up -d
clear
sudo docker ps
clear
sudo docker-compose exec acme-mailcow /acme.sh --renew
openssl s_client -connect tudominio.com:443
clear
exit
clear
sudo docker-compose exec acme-mailcow /acme.sh --issue -d connectia.info -d smartcalling.cl -d fijodigital.cl
sudo docker ps
sudo ls /root/mailcow-dockerized/data/assets/ssl/
sudo docker-compose restart nginx-mailcow postfix-mailcow dovecot-mailcow
clear
cd /root/mailcow-dockerized/
sudo docker-compose restart nginx-mailcow postfix-mailcow dovecot-mailcow
sudo docker ps
openssl s_client -connect connectia.info:443
clear
sudo docker-compose exec acme-mailcow /acme.sh --renew -d connectia.info -d smartcalling.cl -d fijodigital.cl
clear
sudo docker-compose exec acme-mailcow sh
sudo ls /root/mailcow-dockerized/data/assets/ssl/
sudo docker-compose restart nginx-mailcow postfix-mailcow dovecot-mailcow
clear
sudo docker-compose exec acme-mailcow /root/.acme.sh/acme.sh --issue -d connectia.info -d smartcalling.cl -d fijodigital.cl
sudo ls /root/mailcow-dockerized/data/assets/ssl/
openssl s_client -connect connectia.info:443
clear
/root/.acme.sh/acme.sh --issue -d connectia.info -d smartcalling.cl -d fijodigital.cl --nginx
clear
sudo docker ps
sudo docker exec -it mailcowdockerized_acme-mailcow_1 sh
clear
which nginx
clear
/root/.acme.sh/acme.sh --issue -d connectia.info -d smartcalling.cl -d fijodigital.cl --dns
clear
sudo docker exec -it mailcowdockerized_acme-mailcow_1 sh
clear
sudo docker exec -it mailcowdockerized_acme-mailcow_1 sh
clear
cat /etc/os-release
sudo apt update && sudo apt upgrade -y
exit
sudo systemctl status nginx
sudo systemctl status dovecot
sudo systemctl status postfix
sudo systemctl status acme.sh
/etc/nginx/nginx.conf
cat /etc/nginx/sites-available/
cat /etc/nginx/nginx.conf
/etc/ssl/
cd /etc/ssl/
ls -lt
cd ..
tail -f /var/log/nginx/error.log
tail -f /var/log/mail.log
tail -f /var/log/dovecot.log
tail -f /root/.acme.sh/acme.sh.log
sudo ufw status
sudo netstat -tuln
clear
sudo systemctl enable postfix
sudo systemctl start postfix
sudo systemctl enable dovecot
sudo systemctl start dovecot
sudo systemctl status postfix
sudo systemctl status dovecot
clear
sudo netstat -tuln | grep ':143\|:993'
sudo nano /etc/dovecot/dovecot.conf
cat /etc/dovecot/dovecot.conf
sudo journalctl -xeu dovecot.service
sudo systemctl stop apache2
sudo systemctl disable apache2
clear
sudo ss -tuln | grep ':143\|:993'
sudo systemctl stop apache2
sudo systemctl disable apache2
sudo systemctl restart postfix
sudo systemctl restart dovecot
sudo systemctl status dovecot
sudo tail -f /var/log/dovecot.log
clear
sudo ss -tuln | grep ':143\|:993'
ls /etc/dovecot/conf.d/
cat /etc/dovecot/conf.d/10-auth.conf
cat /etc/dovecot/conf.d/10-lmtp.conf
cat /etc/dovecot/conf.d/10-mail.conf
cat /etc/dovecot/conf.d/10-master.conf
cat /etc/dovecot/conf.d/20-lmtp.conf.bak
cat /etc/dovecot/conf.d/20-managesieve.conf
clear
sudo lsof -i :143
sudo lsof -i :993
sudo docker ps
clear
sudo docker stop mailcowdockerized_dovecot-mailcow_1
sudo systemctl restart dovecot
sudo ss -tuln | grep ':143\|:993'
sudo systemctl status dovecot
clear
sudo nano /etc/dovecot/conf.d/10-ssl.conf
sudo systemctl restart dovecot
sudo ss -tuln | grep ':143\|:993'
sudo ufw allow 143
sudo ufw allow 993
openssl s_client -connect smartcalling.cl:993
sudo tail -f /var/log/mail.log
clear
sudo lsof -i :143
sudo lsof -i :993
sudo docker stop mailcowdockerized_dovecot-mailcow_1
sudo ss -tuln | grep ':143\|:993'
sudo systemctl restart dovecot
sudo systemctl status dovecot
clear
root@vmi2599867:/# sudo lsof -i :143
sudo lsof -i :993
root@vmi2599867:/# sudo docker stop mailcowdockerized_dovecot-mailcow_1
mailcowdockerized_dovecot-mailcow_1
root@vmi2599867:/# sudo ss -tuln | grep ':143\|:993'
root@vmi2599867:/# sudo systemctl restart dovecot
Job for dovecot.service failed because the control process exited with error code.
See "systemctl status dovecot.service" and "journalctl -xeu dovecot.service" for details.
root@vmi2599867:/# sudo systemctl status dovecot
× dovecot.service - Dovecot IMAP/POP3 email server
Jun 27 13:15:47 vmi2599867.contaboserver.net systemd[1]: Starting Dovecot IMAP/POP3 email server...
Jun 27 13:15:47 vmi2599867.contaboserver.net dovecot[1001320]: doveconf: Fatal: Error in configuration file /etc/dovecot/conf.d/10-ssl.conf line 2: ssl_cert: Can't open file /etc>
Jun 27 13:15:47 vmi2599867.contaboserver.net systemd[1]: dovecot.service: Main process exited, code=exited, status=89/n/a
Jun 27 13:15:47 vmi2599867.contaboserver.net systemd[1]: dovecot.service: Failed with result 'exit-code'.
Jun 27 13:15:47 vmi2599867.contaboserver.net systemd[1]: Failed to start Dovecot IMAP/POP3 email server.
lines 1-14/14 (END)



clear
ls /etc/letsencrypt/live/connectia.info/
sudo nano /etc/dovecot/conf.d/10-ssl.conf
sudo systemctl restart dovecot
sudo systemctl status dovecot
sudo ss -tuln | grep ':143\|:993'
clear
sudo ls -l /etc/letsencrypt/live/
sudo ls -l /etc/letsencrypt/live/connectia.info/
sudo cat /etc/dovecot/conf.d/10-ssl.conf | grep -v '^#' | grep -v '^$'
sudo postconf | grep -i tls
sudo cat /etc/postfix/main.cf | grep -Ei 'smtpd_tls|smtpd_use_tls|ssl|cert|key|hostname'
sudo cat /etc/roundcube/config.inc.php | grep -i smtp -A 5
clear
sudo ufw status
sudo firewall-cmd --list-all
sudo ufw allow 587/tcp
sudo ufw allow 993/tcp
sudo ufw allow 995/tcp
sudo ufw reload
sudo netstat -ltnp | grep 587
sudo ss -ltnp | grep 587
clear
sudo docker ps
sudo docker container ls --format "table {{.ID}}\t{{.Names}}\t{{.Ports}}"
clear
cd /opt/mailcow-dockerized  # o donde sea que esté mailcow, si no, solo haz el stop general
sudo docker-compose down
sudo docker stop $(sudo docker ps -q)
sudo rm -rf /opt/mailcow-dockerized
sudo docker system prune -a
sudo systemctl restart postfix
sudo systemctl restart dovecot
sudo ss -ltnp | grep -E '25|465|587|993|995'
clear
sudo cat /etc/dovecot/dovecot-sql.conf.ext
mysql -u pfadmin -p'P4ssw0rdSeguro!' -h localhost postfixadmin   -e "SELECT username, password \
      FROM mailbox \
      WHERE username='mario.yanez@smartcalling.cl' \
        AND active=1;"
sudo doveadm pw -s MD5 -p 'SmartCalling2025!'
echo -n 'SmartCalling2025!' | md5sum
clear
grep -R "protocols" /etc/dovecot/conf.d/10-mail.conf
grep -R "service imap-login" /etc/dovecot/conf.d/10-master.conf -A5
grep -R "service pop3-login" /etc/dovecot/conf.d/10-master.conf -A5
grep -R "ssl_cert" /etc/dovecot/conf.d/10-ssl.conf
grep -R "ssl_key" /etc/dovecot/conf.d/10-ssl.conf
netstat -tulpn | grep dovecot
grep -R "submission" /etc/postfix/master.cf -n
postconf -n | grep -E 'smtpd_tls_security_level|smtp_tls_security_level'
postconf -n | grep -E 'smtpd_tls_cert_file|smtpd_tls_key_file'
clear
# 1. Averiguar el hostname que usa Postfix (será tu servidor SMTP/IMAP)
postconf -h myhostname
# 2. Confirmar qué protocolos tiene habilitados Dovecot
grep -R '^protocols' /etc/dovecot/conf.d/10-mail.conf
# 3. Ver en qué puertos está escuchando Dovecot (IMAP/POP3)
ss -plnt | grep dovecot
clear
sudo postqueue -p
sudo mailq
sudo postqueue -p | grep -i 'mario.yanez@smartcalling.cl' -B2 -A2
clear
maildir=$(mysql -N -u pfadmin -p'P4ssw0rdSeguro!' -h localhost postfixadmin \
  -e "SELECT maildir FROM mailbox WHERE username='mario.yanez@smartcalling.cl';")
echo "Maildir: $maildir"
for msg in /var/mail/vhosts/${maildir}/{cur,new}/*; do   echo "---- Mensaje: $(basename "$msg") ----";   grep -m1 '^To: ' "$msg" | sed 's/^To: /Destinatario: /';   grep -m1 '^Date: ' "$msg" | sed 's/^Date: /Fecha: /';   echo; done
clear
sudo grep "to=<mario.yanez@smartcalling.cl>" /var/log/mail.log* | tail -n 100
clear
ls -l --time-style=long-iso /var/mail/vhosts/smartcalling.cl/mario.yanez/cur   | awk '{print $6 " " $7 " " $9}'
sudo grep 'imap-login: Login:' /var/log/mail.log   | grep 'user=<mario.yanez@smartcalling.cl>'   | tail -n 20
clear
mysql -u pfadmin -p'P4ssw0rdSeguro!' -h localhost mailserver   -e "SHOW TABLES;"
mysql -u pfadmin -p'P4ssw0rdSeguro!' -h localhost mailserver   -e "DESCRIBE NOMBRE_DE_LA_TABLA;"
clear
sudo mysql
cd /var/www/html/
cat .env
ls
clera
clear
cd ..
clear
sudo find / -type f -name ".env" 2>/dev/null
cat /var/www/mailpanel/.env
clear
mysql -u root -p'Soyelniko1' -h 127.0.0.1 mailserver   -e "SHOW TABLES;"
mysql -u root -p'Soyelniko1' -h 127.0.0.1 mailserver   -e "DESCRIBE buzons;"
clear
mysql -u root -p'Soyelniko1' -h 127.0.0.1 mailserver   -e "DESCRIBE jobs;"
mysql -u root -p'Soyelniko1' -h 127.0.0.1 mailserver   -e "SELECT id, queue, attempts, reserved_at, available_at, created_at \
      FROM jobs \
      ORDER BY created_at DESC \
      LIMIT 20;"
mysql -u root -p'Soyelniko1' -h 127.0.0.1 mailserver   -e "DESCRIBE failed_jobs;"
mysql -u root -p'Soyelniko1' -h 127.0.0.1 mailserver   -e "SELECT id, connection, queue, payload, exception, failed_at \
      FROM failed_jobs \
      ORDER BY failed_at DESC \
      LIMIT 20;"
clear
ls -l --time-style=long-iso /var/mail/vhosts/smartcalling.cl/mario.yanez/new   | awk '{print $6 " " $7 " " $9}'
sudo doveadm mailbox status -u mario.yanez@smartcalling.cl INBOX   messages unseen
clear
ls -l --time-style=long-iso   /var/mail/vhosts/smartcalling.cl/mario.yanez/Maildir/new | awk '{print $6 " " $7 "  " $9}'
ls -l --time-style=long-iso   /var/mail/vhosts/smartcalling.cl/mario.yanez/Maildir/cur | awk '{print $6 " " $7 "  " $9}'
sudo doveadm -u mario.yanez@smartcalling.cl   mailbox status INBOX messages unseen
clear
sudo grep -R "\$config\['default_host'\]" /etc/roundcube/config.inc.php -n
sudo grep -R "\$config\['imap_host'\]"    /etc/roundcube/config.inc.php -n
sudo grep -R "\$config\['default_port'\]"  /etc/roundcube/config.inc.php -n
sudo grep -R "\$config\['imap_port'\]"     /etc/roundcube/config.inc.php -n
sudo grep -R "\$config\['imap_conn_options'\]" /etc/roundcube/config.inc.php -n
sudo grep -R "db_dsnw" /etc/roundcube/config.inc.php -n
mysql -u rcuser -p'rcpass' roundcube -e "SHOW TABLES;"
clear
echo "--- Sistema operativo ---"
cat /etc/os-release
echo "--- Versión de Git ---"
if command -v git >/dev/null 2>&1; then git --version; else echo "Git NO instalado"; fi
echo "--- Usuario deployer ---"
if id deployer >/dev/null 2>&1; then id deployer; else echo "Usuario deployer NO existe"; fi
echo "--- Claves SSH en /root/.ssh ---"
ls -la /root/.ssh 2>/dev/null || echo "No existe /root/.ssh"
echo "--- Claves SSH en /home/deployer/.ssh ---"
ls -la /home/deployer/.ssh 2>/dev/null || echo "No existe /home/deployer/.ssh"
echo "--- Buscando carpeta mailserver-config ---"
find /home -maxdepth 2 -type d -name mailserver-config 2>/dev/null || echo "No encontrado en /home"
find /root -maxdepth 2 -type d -name mailserver-config 2>/dev/null || echo "No encontrado en /root"
echo "--- Estado de Postfix y Dovecot ---"
systemctl status postfix dovecot --no-pager
echo "--- Contenido de /etc/postfix ---"
ls -R /etc/postfix 2>/dev/null || echo "/etc/postfix no existe"
echo "--- Contenido de /etc/dovecot ---"
ls -R /etc/dovecot 2>/dev/null || echo "/etc/dovecot no existe"
clear
sudo adduser --disabled-password --gecos "" deployer
sudo usermod -aG sudo deployer
sudo mkdir -p /home/deployer/.ssh
sudo chmod 700 /home/deployer/.ssh
sudo cp /root/.ssh/id_ed25519.pub /home/deployer/.ssh/authorized_keys
sudo chown deployer:deployer /home/deployer/.ssh/authorized_keys
sudo chmod 600 /home/deployer/.ssh/authorized_keys
exit
clear
sudo passwd deployer
exit
clear
# 2.1. Asegúrate de que exista la carpeta .ssh de deployer
mkdir -p /home/deployer/.ssh
# 2.2. Añade la clave pública al authorized_keys
cat /root/github_actions_deploy.pub >> /home/deployer/.ssh/authorized_keys
# 2.3. Ajusta permisos
chown -R deployer:deployer /home/deployer/.ssh
chmod 700 /home/deployer/.ssh
chmod 600 /home/deployer/.ssh/authorized_keys
# 2.4. Limpia
rm /root/github_actions_deploy.pub
exit
