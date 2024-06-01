<?php
error_reporting(E_ALL ^ E_DEPRECATED);

require_once __DIR__.'/vendor/autoload.php';

define('BASE_URL','http://'.$_SERVER['HTTP_HOST'].str_replace(basename(__FILE__),'',explode('?',$_SERVER['REQUEST_URI'])[0]));


