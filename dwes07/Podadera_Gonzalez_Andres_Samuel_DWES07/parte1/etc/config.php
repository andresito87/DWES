<?php
// AVISO: Se añade al proyecto una dependencia para poder usar variables de entorno composer require vlucas/phpdotenv, la idea es tener un .env.example con las variables de entorno simuladas que se subira al repositorio y un .env que no se subira al repositorio con las variables reales
use Dotenv\Dotenv;

// Carga las variables de entorno desde el archivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$dotenv->load();

// Accede a la variable de entorno API_KEY
$apiKey = $_ENV['VIRUS_TOTAL_API_KEY'];

// TODO: Eliminar archivo .env
define("VIRUS_TOTAL_API_KEY", $apiKey);
define("DATOS", __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'subidas' . DIRECTORY_SEPARATOR . 'datos_archivos_subidos.ser');
define("CARPETA_SUBIDAS", __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'subidas');

