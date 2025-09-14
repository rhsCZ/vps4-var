<?php

/* Local configuration for Roundcube Webmail */
// system error reporting, sum of: 1 = log; 4 = show
#$config['debug_level'] = 5;

// Log SQL queries
#$config['sql_debug'] = true;

// Log IMAP conversation
#$config['imap_debug'] = true;

// Log LDAP conversation
#$config['ldap_debug'] = true;

// Log SMTP conversation
#$config['smtp_debug'] = true;
// ----------------------------------
// SQL DATABASE
// ----------------------------------
// Database connection string (DSN) for read+write operations
// Format (compatible with PEAR MDB2): db_provider://user:password@host/database
// Currently supported db_providers: mysql, pgsql, sqlite, mssql, sqlsrv, oracle
// For examples see http://pear.php.net/manual/en/package.database.mdb2.intro-dsn.php
// Note: for SQLite use absolute path (Linux): 'sqlite:////full/path/to/sqlite.db?mode=0646'
//       or (Windows): 'sqlite:///C:/full/path/to/sqlite.db'
// Note: Various drivers support various additional arguments for connection,
//       for Mysql: key, cipher, cert, capath, ca, verify_server_cert,
//       for Postgres: application_name, sslmode, sslcert, sslkey, sslrootcert, sslcrl, sslcompression, service.
//       e.g. 'mysql://roundcube:@localhost/roundcubemail?verify_server_cert=false'
$config['db_dsnw'] = 'mysql://roundcube:U07H7v%26%25kYZT@localhost/roundcube';

// ----------------------------------
// IMAP
// ----------------------------------
// The IMAP host (and optionally port number) chosen to perform the log-in.
// Leave blank to show a textbox at login, give a list of hosts
// to display a pulldown menu or set one host as string.
// Enter hostname with prefix ssl:// to use Implicit TLS, or use
// prefix tls:// to use STARTTLS.
// If port number is omitted it will be set to 993 (for ssl://) or 143 otherwise.
// Supported replacement variables:
// %n - hostname ($_SERVER['SERVER_NAME'])
// %t - hostname without the first part
// %d - domain (http hostname $_SERVER['HTTP_HOST'] without the first part)
// %s - domain name after the '@' from e-mail address provided at login screen
// For example %n = mail.domain.tld, %t = domain.tld
// WARNING: After hostname change update of mail_host column in users table is
//          required to match old user data records with the new host.
$config['imap_host'] = 'ssl://imap.%t:993';
$config['smtp_host'] = 'ssl://smtp.%t:465';
//$config['imap_host'] = 'ssl://playground.rhscz.eu:993';
//$config['smtp_host'] = 'ssl://playground.rhscz.eu:465';
// provide an URL where a user can get support for this Roundcube installation
// PLEASE DO NOT LINK TO THE ROUNDCUBE.NET WEBSITE HERE!
$config['support_url'] = '';
$config['imap_debug'] = false;
// This key is used for encrypting purposes, like storing of imap password
// in the session. For historical reasons it's called DES_key, but it's used
// with any configured cipher_method (see below).
// For the default cipher_method a required key length is 24 characters.
$config['des_key'] = '7FZ6FMV5fxLsAz6ANqbyzGDf';
$config['enable_installer'] = false;
// ----------------------------------
// PLUGINS
// ----------------------------------
// List of active plugins (in plugins/ directory)
$config['plugins'] = ['acl', 'archive', 'attachment_reminder', 'emoticons', 'filesystem_attachments', 'help', 'jqueryui', 'managesieve', 'userinfo', 'zipdownload', 'password', 'postfixadmin_user_identities'];

// Make use of the built-in spell checker.
$config['enable_spellcheck'] = true;
$config['managesieve_host'] = 'tls://%h';
$config['managesieve_auth_type'] = null;
//$rcmail_config['managesieve_port'] = 4190;
$config['managesieve_debug'] = false;
$config['managesieve_usetls'] = true;
$config['managesieve_conn_options'] = array(
  'ssl'         => array(
    'verify_peer'  => true,
     'allow_self_signed' => true,
     'capath'  => '/etc/ssl/certs',
   )
);
$config['managesieve_vacation'] = 1;
$config['managesieve_forward'] = 1;
$config['managesieve_vacation_addresses_init'] = true;
//$config['identities_level'] = 3
$config['identities_level'] = 1;
$config['password_confirm_current'] = true;
$config['password_minimum_length'] = 8;
$config['password_force_save'] = true;
$config['password_algorithm'] = 'sha512-crypt';
$config['password_algorithm_prefix'] = '{SHA512-CRYPT}';
//$config['password_algorithm'] = 'dovecot';
//$config['password_dovecotpw'] = '/usr/bin/doveadm pw';
//$config['password_dovecotpw_method'] = 'CRAM-MD5';
//$config['password_dovecotpw_with_method'] = true;
$config['password_disabled'] = false;
$config['password_db_dsn'] = 'mysql://postfixadmin:PDPa%Ghnhd2YHpBN@localhost/postfixadmin';
//$config['password_query'] = 'SELECT update_passwd(%c, %u)';
$config['password_query'] = "UPDATE `mailbox` SET `password` = %P WHERE `username` = %u AND `password` = %O;";
$config['password_log'] = false;
$config['toolbox_tools'] = [
    'aliases',
];
//$config['toolbox_postfix_dsnw'] = 'mysql://postfixadmin:PDPa%Ghnhd2YHpBN@localhost/postfixadmin';
//$config['toolbox_roundcube_dsnw'] = 'mysql://roundcube:U07H7v%26%25kYZT@localhost/roundcube';
