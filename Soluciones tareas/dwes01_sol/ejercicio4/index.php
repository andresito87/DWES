<?php

require_once 'funciones.php';

$datos=cargar_archivo('datos.csv');
if ($datos)
{
    echo "<H2>Datos cargados</H2>";
    var_dump($datos);
    $datosfiltrados=filtrar_por_curso('1ESO',$datos);
    echo "<H2>Datos filtrados por 1ESO</H2>";
    var_dump($datosfiltrados);
    $resumen=resumen($datosfiltrados);
    echo "<H2>Resumen por ASGS</H2>";
    var_dump($resumen);
}