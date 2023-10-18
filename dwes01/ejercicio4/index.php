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
    include_once("cargar_archivo.php");
    $archivo = "datos.csv";
    $array = cargar_archivo($archivo);

    include_once("mostrar_array.php");
    echo "<h2>Array sin filtrar</h2>";
    mostrar_array($array);

    include_once("filtrar_por_curso.php");
    $curso = "1ESO";
    $array_filtrado = filtrar_por_curso($curso, $array);
    echo "<h2>Array filtrado por curso: $curso</h2>";
    mostrar_array($array_filtrado);

    include_once("obtener_resumen.php");
    echo "<h3>Contabilización de asignaturas:</h3>";
    $array_asignaturas = obtener_resumen_asg($array);
    foreach ($array_asignaturas as $key => $value) {
        echo "<ul>";
        foreach ($value as $key2 => $value2) {
            echo "<li>$key2: $value2</li>";
        }
        echo "</ul>";
    }

    //Link to repository: https://github.com/andresito87/DWES/tree/main/dwes01/ejercicio4
    ?>

</body>

</html>