<?php
/*12. Implementa una funcionalidad para importar un archivo CSV y actualizar luego dicho CSV y
guardarlo.*/

//Cuando se pulsa el botón de importar, se lee el archivo CSV
// y se muestra en una tabla con un formulario para cada usuario.
if (isset($_POST['importar']) && $_POST['importar'] == "Importar") {
    $usuarios = array();
    $archivo = fopen("usuarios.csv", "r");
    while (($datos = fgetcsv($archivo)) !== FALSE) {
        $usuarios[] = $datos;
    }
    fclose($archivo);
    echo "<table>";
    foreach ($usuarios as $numeroUsuario => $usuario) {
        echo "<tr>";
        echo "<form action='ejercicio12.php' method='post'>";
        echo "<input type='hidden' name='numeroUsuario' value='$numeroUsuario'>";
        echo "<input type='text' name='nombre' value='$usuario[0]'>";
        echo "<input type='text' name='apellido' value='$usuario[1]'>";
        echo "<input type='text' name='edad' value='$usuario[2]'>";
        echo "<input type='submit' name='actualizar' value='Actualizar'>";
        echo "</form>";
        echo "</tr>";
        echo "<br>";
    }
    echo "</table>";
}

//Cuando se pulsa el botón de actualizar, se actualiza el archivo CSV
if (isset($_POST['actualizar'])) {
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT);
    $numeroUsuario = filter_input(INPUT_POST, 'numeroUsuario', FILTER_VALIDATE_INT);
    $archivo = fopen("usuarios.csv", "r");
    $usuarios = array();
    //Se lee el archivo CSV y se guarda en un array
    while (($datos = fgetcsv($archivo)) !== FALSE) {
        $usuarios[] = $datos;
    }
    //Se cierra el archivo
    fclose($archivo);
    //Se actualiza el usuario en el array
    if (isset($usuarios[$numeroUsuario])) {
        //Se actualiza el usuario en el array
        $usuarios[$numeroUsuario] = array($nombre, $apellido, $edad);
        //Se vacía el archivo CSV
        $archivo = fopen("usuarios.csv", "w");
        //Se escribe el array en el archivo CSV
        foreach ($usuarios as $usuario) {
            fputcsv($archivo, $usuario);
        }
    }
    echo "Usuario " . $nombre . " " . $apellido . " con edad " . $edad . " actualizado";
}

//Cuando se pulsa el botón de enviar, se añade un nuevo usuario al archivo CSV
if (isset($_POST['enviar'])) {
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT);
    $archivo = fopen("usuarios.csv", "a");
    fputcsv($archivo, array($nombre, $apellido, $edad));
    fclose($archivo);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 12</title>
</head>

<body>
    <!--Formulario para importar el archivo CSV-->
    <form action="ejercicio12.php" method="post">
        <input type="submit" name="importar" value="Importar">
    </form>
    <!--Formulario para añadir un nuevo usuario-->
    <form action="ejercicio12.php" method="post">
        <label for="nombre">Nombre
            <input type="text" name="nombre" id="nombre">
        </label>
        <label for="apellido">Apellido
            <input type="text" name="apellido" id="apellido">
        </label>
        <label for="edad">Edad
            <input type="text" name="edad" id="edad">
        </label>
        <input type="submit" name="enviar" value="Enviar">
    </form>
</body>

</html>