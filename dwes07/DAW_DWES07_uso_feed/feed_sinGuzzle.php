<?php

$url="http://www.juntadeandalucia.es/educacion/portals/delegate/rss/ced/portalconsejeria/alumnado/-/-/false/OR/true/ishare_noticefrom/DESC/";
$contenidoDelFeed=file_get_contents($url);
echo $contenidoDelFeed;