<?php
/*8. Desarrolla una aplicación que pase datos codificados con `urlencode` a través de un formulario y los
recupere y decodifique en otra página.*/

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
    <title>Ejercicio 8a</title>
</head>
<body>
<form action="ejercicio8b.php" method="get">
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

