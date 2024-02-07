<?php

/*11. Desarrolla un script PHP que tome datos de un formulario y los guarde en un archivo CSV.*/

if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['edad'])) {
    $nombre = filter_input(INPUT_POST,'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $apellido = filter_input(INPUT_POST,'apellido', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $edad = filter_input(INPUT_POST,'edad', FILTER_VALIDATE_INT);
    $archivo = fopen("usuarios.csv", "a");
    echo $nombre;
    echo $apellido;
    echo $edad;
    fputcsv($archivo, array($nombre, $apellido, $edad));
    fclose($archivo);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 11</title>
</head>
<body>
<form action="ejercicio11.php" method="post">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre">
    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" id="apellido">
    <label for="edad">Edad</label>
    <input type="text" name="edad" id="edad">
    <input type="submit" value="Enviar">
</form>
</body>
</html>

