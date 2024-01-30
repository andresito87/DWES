<?php
define('SECCION_DEFECTO','Principal');
define("SALT",'495k5ndikakzFSKZssd');
define("LAST_VISITED_MAX",5);

$secciones=[];
$secciones[] = ['nombre'=>'Principal', 'link'=>'ver contenido principal', 'archivo' => 'fragmentos/principal.html'];
$secciones[] = ['nombre'=>'Contacto', 'link'=>'ver contactos', 'contenido' => 'aquí se mostrará una lista de contactos'];
$secciones[] = ['nombre'=>'Visita EX1', 'link'=>'sección EX1', 'contenido' => 'contenido sección EX1'];
$secciones[] = ['nombre'=>'Visita EX2', 'link'=>'sección EX2', 'contenido' => 'contenido sección EX2'];
$secciones[] = ['nombre'=>'Visita EX3', 'link'=>'sección EX3', 'contenido' => 'contenido sección EX3'];
$secciones[] = ['nombre'=>'Visita EX4', 'link'=>'sección EX4', 'contenido' => 'contenido sección EX4'];
$secciones[] = ['nombre'=>'Desarrollador', 'link'=>'ver desarrollador', 'archivo' => 'fragmentos/desarrollador.html'];
