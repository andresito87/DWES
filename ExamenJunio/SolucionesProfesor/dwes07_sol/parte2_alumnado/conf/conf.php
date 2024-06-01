<?php


define ('DB_DSN','');
define ('DB_USER','');
define ('DB_PASSWD','');
define ('SALT','495k5ndikakzFSKZssd');

if (!defined('DB_USER') || !defined('DB_PASSWD'))
{
    die("<H1>Configura en ".__FILE__." las constantes DB_USER y DB_PASSWD");
}
