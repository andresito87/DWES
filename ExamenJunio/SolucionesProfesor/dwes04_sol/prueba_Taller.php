<?php

require __DIR__.'/vendor/autoload.php';

$pdo=require __DIR__.'/conectarbd.php';

use \DWES04SOL\modelo\Taller;

echo "<H1>Creando taller de prueba</H1>";
$tallerPrueba=new Taller();
$errores=0;
$tallerPrueba->setNombre('Ejemplo Taller') || $errores++;
$tallerPrueba->setDescripcion('Ejemplo Descripcion')  || $errores++;
$tallerPrueba->setUbicacion('test')  || $errores++;
$tallerPrueba->setDia_semana('lunes')  || $errores++;
$tallerPrueba->setHora_inicio('12:00')  || $errores++;
$tallerPrueba->setHora_fin('13:00')  || $errores++;
$tallerPrueba->setCupo_maximo(10)  || $errores++;

if ($errores>0)
{
    die("Hay $errores en los datos del taller");
}
else
{
    echo "<H2>Volcado datos taller</H2>";
    var_dump($tallerPrueba);
}

echo "<H1>Prueba guardar</H1>";
$resultado=$tallerPrueba->guardar($pdo);
echo "<H2>Resultado de guardar:<H2>";
var_dump($resultado);
echo "<H2>Volcado datos taller</H2>";
var_dump($tallerPrueba);
$idTaller=$tallerPrueba->getId();

echo "<H1>Prueba rescatar</H1>";
$tallerPrueba=Taller::rescatar($pdo,$idTaller);
echo "<H2>Volcado datos taller rescatado</H2>";
var_dump($tallerPrueba);

echo "<H1>Prueba actualizar</H1>";
$tallerPrueba->setNombre('Ejemplo Taller Mod') || $errores++;
$tallerPrueba->setDescripcion('Ejemplo Descripcion Mod')  || $errores++;
$tallerPrueba->setUbicacion('test Mod')  || $errores++;
$tallerPrueba->setDia_semana('martes')  || $errores++;
$tallerPrueba->setHora_inicio('10:00')  || $errores++;
$tallerPrueba->setHora_fin('11:00')  || $errores++;
$tallerPrueba->setCupo_maximo(15)  || $errores++;

if ($errores>0)
{
    die("Hay $errores en los datos del taller");
}
else
{
    echo "<H2>Volcado datos taller modificado</H2>";
    var_dump($tallerPrueba);
    $tallerPrueba->guardar($pdo);
}
echo "<H2>Volcado datos taller rescatado</H2>";

echo "<H1>Prueba rescatar después de guardar modificaciones</H1>";
$tallerPrueba=Taller::rescatar($pdo,$idTaller);
echo "<H2>Volcado datos taller rescatado</H2>";
var_dump($tallerPrueba);

echo "<H1>Eliminacion Taller</H1>";
$resultado=Taller::borrar($pdo,$idTaller);
var_dump($resultado);

echo "<H1>Prueba rescatar después de eliminación</H1>";
$tallerPrueba=Taller::rescatar($pdo,$idTaller);
echo "<H2>Volcado datos taller rescatado</H2>";
var_dump($tallerPrueba);

