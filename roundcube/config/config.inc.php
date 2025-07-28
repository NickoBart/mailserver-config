<?php
/**
 * Roundcube main configuration file
 */

$config = [];

// -----------------------------------------------------------------------------
// Base de datos
// -----------------------------------------------------------------------------
include_once __DIR__.'/debian-db.php';

// -----------------------------------------------------------------------------
// IMAP (llegada)
// -----------------------------------------------------------------------------
$config['default_host'] = 'ssl://mail.connectia.info'; // IMAP seguro
$config['default_port'] = 993;
$config['imap_conn_options'] = [
    'ssl' => [
        'verify_peer'       => false,
        'verify_peer_name'  => false,
        'allow_self_signed' => true,
    ],
];

// -----------------------------------------------------------------------------
// SMTP (envío) — STARTTLS + AUTH PLAIN en submission (587)
// -----------------------------------------------------------------------------
$config['smtp_server']    = 'mail.connectia.info'; // No usar ssl:// ni tls:// aquí
$config['smtp_port']      = 587;
$config['smtp_user']      = '%u'; // Usa el usuario con el que te logueas
$config['smtp_pass']      = '%p';
//$config['smtp_secure']    = 'tls';    // Usa STARTTLS
$config['smtp_auth_type'] = 'LOGIN';  // Postfix anuncia PLAIN tras STARTTLS
$config['smtp_helo_host'] = 'mail.connectia.info';
$config['smtp_conn_options'] = [
    'ssl' => [
        'verify_peer'       => false,
        'verify_peer_name'  => false,
        'allow_self_signed' => true,
    ],
];
$config['smtp_log']      = true;
$config['smtp_log_file'] = '/var/log/roundcube/smtp.log';
$config['smtp_force_default_server'] = true;

// -----------------------------------------------------------------------------
// Skin & UI
// -----------------------------------------------------------------------------
$config['skin']         = 'elastic';
$config['product_name'] = 'Connectia Webmail';
$config['support_url']  = '';

// -----------------------------------------------------------------------------
// Plugins
// -----------------------------------------------------------------------------
$config['plugins_dir'] = __DIR__.'/../plugins';
$config['plugins'] = [
    'autologon', 'managesieve', 'filesystem_attachments',
    'additional_message_headers', 'archive', 'attachment_reminder',
    'debug_logger', 'emoticons', 'enigma', 'example_addressbook', 'help',
    'hide_blockquote', 'http_authentication', 'identicon', 'identity_select',
    'krb_authentication', 'newmail_notifier', 'new_user_dialog',
    'new_user_identity', 'password', 'reconnect',
    'show_additional_headers', 'squirrelmail_usercopy', 'subscriptions_option',
    'userinfo', 'vcard_attachments', 'virtuser_file', 'virtuser_query', 'zipdownload'
];

// -----------------------------------------------------------------------------
// Otras opciones
// -----------------------------------------------------------------------------
$config['host_dropdown']       = false;
$config['username_domain']     = '';
$config['enable_spellcheck']   = false;
$config['des_key']             = 'zG5of/xgHX1bUcZamE3Tpuap';
$config['debug_level']         = 4;
$config['log_driver']          = 'file';
$config['log_date_format']     = 'Y-m-d H:i:s';

