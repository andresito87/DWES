<?php
require_once 'funciones.php';

//Cargamos el archivo csv en un array
$archivo = "datos.csv";
$array_cargado = cargar_archivo($archivo);

//Filtramos por curso
$curso = "1ESO";
if ($array_cargado) {
    $array_filtrado = filtrar_por_curso($curso, $array_cargado);
    //Obtenemos el resumen de asignaturas
    $array_asignaturas = obtener_resumen_asg($array_cargado);
} else {
    $error = "No se ha podido cargar el archivo";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 - Funciones</title>
</head>

<body>
    <h1>El contenido del archivo csv es:</h1>

    <?php
    //Si se pudo cargar el archivo, mostramos el array
    if (is_array($array_cargado) && !empty($array_cargado)) {
        echo "<h2>Array sin filtrar</h2>";
        mostrar_array($array_cargado);

        echo "<h2>Array filtrado por curso: $curso</h2>";
        mostrar_array($array_filtrado);

        //Mostramos el resumen de asignaturas
        echo "<h3>Contabilización de asignaturas:</h3>";
        mostrar_contabilizacion($array_asignaturas);
    }
    //Sino mostramos un mensaje de error
    else {
        echo "<p>$error</p>";
    }
    ?>
</body>

</html>