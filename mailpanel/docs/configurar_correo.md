# Guía: Cómo configurar tu correo

Esta guía explica paso a paso cómo añadir registros DNS y configurar tu cliente de correo para usar el servicio “Correo Corporativo Chile”.

---

## 1. Registros DNS necesarios

Para que tu dominio funcione correctamente con nuestro servicio de correo, debes crear los siguientes registros en el panel de tu proveedor DNS:

| Tipo  | Nombre / Host          | Valor / Contenido                                               | Prioridad / TTL |
|-------|------------------------|-----------------------------------------------------------------|-----------------|
| MX    | @                      | mail.tudominio.com                                              | 10 / 3600       |
| A     | mail                   | [IP_DEL_SERVIDOR_MAIL]                                          | — / 3600        |
| SPF   | @                      | \`v=spf1 a mx include:spf.correo-corporativo.cl ~all\`            | — / 3600        |
| DKIM  | default._domainkey     | \`v=DKIM1; k=rsa; p=[TU_CLAVE_PÚBLICA_DKIM]\`                     | — / 3600        |
| DMARC | _dmarc                 | \`v=DMARC1; p=quarantine; rua=mailto:postmaster@tudominio.com\`   | — / 3600        |

> **Nota:**  
> - Sustituye \`[IP_DEL_SERVIDOR_MAIL]\` por la IP pública de tu servidor de correo.  
> - Para generar tu clave DKIM, usa el comando:  
>   \`\`\`bash
>   opendkim-genkey -t -s default -d tudominio.com
>   \`\`\`  
>   Luego, carga el contenido de \`default._domainkey.txt\` en tu DNS.

---

## 2. Configuración de Postfix

Edita \`/etc/postfix/main.cf\` y añade/modifica:

\`\`\`ini
myhostname = mail.tudominio.com
mydomain = tudominio.com
myorigin = $mydomain
inet_interfaces = all
inet_protocols = ipv4

# Autenticación SASL
smtpd_sasl_type = dovecot
smtpd_sasl_path = private/auth
smtpd_sasl_auth_enable = yes
smtpd_sasl_security_options = noanonymous

# TLS
smtpd_tls_cert_file = /etc/letsencrypt/live/mail.tudominio.com/fullchain.pem
smtpd_tls_key_file  = /etc/letsencrypt/live/mail.tudominio.com/privkey.pem
smtpd_use_tls = yes

# MySQL lookup
virtual_mailbox_domains = mysql:/etc/postfix/mysql-virtual-domains.cf
virtual_mailbox_maps    = mysql:/etc/postfix/mysql-virtual-mailboxes.cf
virtual_alias_maps      = mysql:/etc/postfix/mysql-virtual-aliases.cf
\`\`\`

Recarga Postfix:

\`\`\`bash
sudo systemctl reload postfix
\`\`\`

---

## 3. Configuración de Dovecot

Edita \`/etc/dovecot/dovecot.conf\` o \`/etc/dovecot/conf.d/10-auth.conf\`:

\`\`\`ini
disable_plaintext_auth = no
auth_mechanisms = plain login

!include auth-system.conf.ext
!include auth-sql.conf.ext

service auth {
  unix_listener /var/spool/postfix/private/auth {
    mode = 0660
    user = postfix
    group = postfix
  }
}

ssl = required
ssl_cert = </etc/letsencrypt/live/mail.tudominio.com/fullchain.pem
ssl_key = </etc/letsencrypt/live/mail.tudominio.com/privkey.pem
\`\`\`

Reinicia Dovecot:

\`\`\`bash
sudo systemctl restart dovecot
\`\`\`

---

## 4. Configuración de cliente (Roundcube / Outlook / Thunderbird)

- **Servidor entrante (IMAP):**  
  - Host: \`mail.tudominio.com\`  
  - Puerto: **993**  
  - Seguridad: SSL/TLS  
- **Servidor saliente (SMTP):**  
  - Host: \`mail.tudominio.com\`  
  - Puerto: **587**  
  - Seguridad: STARTTLS  
  - Autenticación con el mismo usuario y contraseña de IMAP.

---

## 5. Pruebas de envío y recepción

1. Desde el servidor, prueba enviar un mail:  
   \`\`\`bash
   echo "Test" | mail -s "Prueba" usuario@tudominio.com
   \`\`\`
2. Revisa la cola de Postfix:  
   \`\`\`bash
   postqueue -p
   \`\`\`
3. En el cliente, comprueba que recibes el correo de prueba.

