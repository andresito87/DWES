<?php


define ('DB_DSN','mysql:dbname=respira;host=localhost');
define ('DB_USER','root');
define ('DB_PASSWD','');
define ('SALT','495k5ndikakzFSKZssd');

if (!defined('DB_USER') || !defined('DB_PASSWD'))
{
    die("<H1>Configura en ".__FILE__." las constantes DB_USER y DB_PASSWD");
}
