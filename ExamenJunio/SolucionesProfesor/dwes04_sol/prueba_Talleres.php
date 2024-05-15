<?php

require __DIR__.'/vendor/autoload.php';

$pdo=require __DIR__.'/conectarbd.php';

use \DWES04SOL\modelo\Talleres;

echo "<H1>Mostrando todos los talleres</H1>";
var_dump(Talleres::listar($pdo));

echo "<H1>Mostrando todos los talleres del lunes</H1>";
var_dump(Talleres::filtrarPorDia($pdo,'lunes'));

echo "<H1>Mostrando todos los talleres de día no válido</H1>";
var_dump(Talleres::filtrarPorDia($pdo,'xxxx'));