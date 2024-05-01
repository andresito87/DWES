<?php
//Código de backend.php
require_once __DIR__.'/setup.php';

use function Jaxon\jaxon; 

if(jaxon()->canProcessRequest())
{
    jaxon()->processRequest();
}