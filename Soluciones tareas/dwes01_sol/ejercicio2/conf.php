<?php
define('SECCION_DEFECTO', 'Principal');
$secciones = [];
//readfile va a leer directamente el contenido del archivo
$secciones[] = ['nombre' => 'Contacto', 'link' => 'ver contactos', 'contenido' => 'aquí se mostrará una lista de contactos'];
$secciones[] = ['nombre' => 'Desarrollador', 'link' => 'ver desarrollador', 'archivo' => 'fragmentos/desarrollador.html'];
$secciones[] = ['nombre' => 'Principal', 'link' => 'ver contenido principal', 'archivo' => 'fragmentos/principal.html'];
