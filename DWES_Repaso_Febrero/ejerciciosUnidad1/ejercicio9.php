<?php
/*9. Crea un formulario HTML que envíe datos a un script PHP y muestra esos datos en la misma página
o en una diferente.*/

if (isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['edad'])) {
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $edad = $_GET['edad'];
    echo "Nombre: " . urldecode($nombre) . "<br>";
    echo "Apellido: " . urldecode($apellido) . "<br>";
    echo "Edad: " . urldecode($edad) . "<br>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 9</title>
</head>
<body>
<form action="ejercicio9.php" method="get">
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
