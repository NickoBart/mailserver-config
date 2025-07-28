<?php
// Roundcube DB configuration
// Use environment variable ROUNDCUBE_DSNW to avoid storing credentials in repo.
// Example: mysql://roundcube:secret@127.0.0.1/roundcube
$rcmail_config = [
    'db_dsnw' => getenv("ROUNDCUBE_DSNW") ?: "mysql://roundcube:password@127.0.0.1/roundcube",
];
