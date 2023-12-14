<?php
define("SECCION_DEFECTO", "Inicio"); //Contendrá el nombre de la sección por defecto
define("MAX_SECCIONES", 5); //Contendrá el número máximo de secciones
define("SALT", "dwes_tarea03"); //Contendrá la sal para encriptar las cookies
$secciones = [];
//PRIMERA SECCIÓN
$secciones[] = [
    "nombre" => "Inicio",
    "link" => "sección 1",
    "archivo" => "fragmento_seccion1.html"
];
//SEGUNDA SECCIÓN
$secciones[] = [
    "nombre" => "Precios",
    "link" => "sección 2",
    "archivo" => "fragmento_seccion2.html"
];
//TERCERA SECCIÓN
$secciones[] = [
    "nombre" => "Quienes somos",
    "link" => "sección 3",
    "archivo" => "fragmento_seccion3.html"
];
//CUARTA SECCIÓN
$secciones[] = [
    "nombre" => "Ayuda",
    "link" => "sección 4",
    "archivo" => "fragmento_seccion4.html"
];
//QUINTA SECCIÓN
$secciones[] = [
    "nombre" => "FAQ",
    "link" => "sección 5",
    "archivo" => "fragmento_seccion5.html"
];
//SEXTA SECCIÓN
$secciones[] = [
    "nombre" => "Contacto",
    "link" => "sección 6",
    "archivo" => "fragmento_seccion6.html"
];
