<?php
/*Teléfonos telemarketing
Desde una empresa de telemarketing nos han pedido crear una pequeña aplicación para gestionar teléfonos a los que 
llamar para venderles cosas varias. Como parte del proyecto vamos a empezar creando la parte del código que permite 
añadir teléfonos a los que llamar a la base de datos.

Esta sección de la aplicación permitirá:

-Añadir teléfonos de personas a la lista de teléfonos. Los teléfonos se añadirán usando el siguiente formato:
[nombre y apellidos3] 123123123; (nombre y apellidos 2) 123123124;
 
-El separador entre teléfono y teléfono puede ser punto y coma, coma, guiones, espacios o tabulaciones, cualquiera de ellos. 
El nombre y apellidos de la persona en cuestión estará entre paréntesis o bien entre corchetes.

-Una vez procesados los teléfonos se almacenarán en la sesión hasta que el operador decida volcarlos a la base de datos. 
Se podrán seguir añadiendo teléfonos, pero no podrá haber teléfonos repetidos. En caso de encontrar un teléfono repetido 
se avisará al operador de forma apropiada mostrando los datos coincidentes.

-Mientras los datos estén en la sesión, el operador podrá eliminar los teléfonos individualmente antes de volcarlos a la base de datos. 
Para ello se mostrarán diferentes checkbox para seleccionar los teléfonos que eliminar.
-Cuando el operador decida podrá volcar los teléfonos a la base de datos. Al realizar esa acción se volcarán todos los teléfonos a una base de datos como la siguiente:
CREATE TABLE IF NOT EXISTS usuarios (
id INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(50) NOT NULL,
telefono VARCHAR(15) UNIQUE NOT NULL
);*/

//obtener usuarios de la base de datos
$con = require_once("conexion_BD.php");
require_once("funciones.php");
$usuarios = obtener_usuarios($con);

$telefonos = array_column($usuarios, "telefono");

session_start();
if (isset($_POST['enviar']) && $_POST['enviar'] == "Enviar") {

    // Definir el patrón de división de los usuarios
    $patron = '/(\d{6,})([,;\t\s-])/';


    // Dividir la cadena en un array usando el patrón
    $arrayUsuarios = preg_split($patron, $_POST['datos']);
    var_dump($arrayUsuarios);

    // Iterar sobre los usuarios
    foreach ($arrayUsuarios as $key => $usuario) {
        //Dividir la información de cada usuario
        $arrayUsuario = preg_split('/\]|\)/', $usuario);
        if (isset($arrayUsuario[1])) {
            $nombre = trim($arrayUsuario[0], "[]()");
            $telefonoSinFiltrar = trim($arrayUsuario[1]);

            $nombreApellidos = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $telefono = filter_var($telefonoSinFiltrar, FILTER_VALIDATE_INT);

            echo $nombreApellidos;
            echo $telefono;

            //Comprobar que no hay numeros de telefono repetidos
            if ($nombreApellidos != "" && $telefono != 0) {
                if (!isset($_SESSION['usuarios']) || !array_key_exists($telefono, $_SESSION['usuarios'])) {
                    $_SESSION['usuarios'][$telefono] = $nombreApellidos;
                    $usuarioAgregado = true;
                } else {
                    $errores[] = 'Teléfono repetido';
                }
            } else {
                $errores[] = 'Información introducida inválida';
            }
        }
    }
}

//En caso de querer eliminar el telefono seleccionado
if (isset($_POST['eliminar']) && $_POST['eliminar'] == "Eliminar") {
    $keyAEliminar = filter_input(INPUT_POST, 'telefonoAEliminar', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //Compruebo si la key es numérica
    if (is_numeric($keyAEliminar))
        unset($_SESSION['usuarios'][$keyAEliminar]);
    $usuarioEliminado = true;
}



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teléfonos - Telemarketing</title>
</head>

<body>
    <h1>Bienenido al sistema de gestión de teléfonos</h1>

    <?php if (!empty($_SESSION['usuarios'])) : ?>
        <h2>Informacióm introducida en la sesión:</h2>
        <table border="1">
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Telefono</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['usuarios'] as $key => $value) : ?>
                    <tr>
                        <td><?= $value ?></td>
                        <td><?= $key ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" value="<?= $key ?>" name="telefonoAEliminar">
                                <input type="hidden" name="accion" value="eliminar">
                                <input type="submit" value="Eliminar" name="eliminar">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>


    <h2>Formulario Telemarketing:</h2>
    <form action="" method="post">
        <label for="datos">Ingrese la lista de usuarios con formato: (el ; puede ser espacio,tabulador,coma,guion)<br>
            [nombre y apellidos 3] 123123123;(nombre y apellidos 4) 123123124;(nombre y apellidos 5) 123123125;[nombre y apellidos 6] 123123126;<br>
            <textarea name="datos" id="datos" cols="30" rows="10"></textarea>
        </label>
        <input type="submit" value="Enviar" name="enviar">
    </form>
    <?php
    if (isset($errores) && !empty($errores)) {
        foreach ($errores as $error) {
            echo "<p>" . $error . "</p>";
        }
    } else if (isset($usuarioEliminado) && $usuarioEliminado) {
        echo '<p>Usuario eliminado correctamente</p>';
    } else if (isset($usuarioAgregado) && $usuarioAgregado) {
        echo '<p>Usuario agregado correctamente</p>';
    }


    ?>
</body>

</html>