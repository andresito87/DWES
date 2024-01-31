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
//var_dump($usuarios);

session_start();
if (isset($_POST['enviar']) && $_POST['enviar'] == "Enviar") {

    // Definir el patrón de división de los usuarios
    $patron = '/(?<=\d)([;;,-]|\s)+/';

    // Dividir la cadena en un array usando el patrón
    $arrayUsuarios = preg_split($patron, $_POST['datos']);
    if (isset($arrayUsuarios[1])) {
        // Iterar sobre los usuarios
        foreach ($arrayUsuarios as $key => $usuario) {
            //Dividir la información de cada usuario
            $arrayUsuario = preg_match('/(?:\[|\()((?:[\s|\w\d])+)(?:\]|\))\s*(\d+)/', $usuario, $matches);
            $arrayUsuario = array_slice($matches, 1);
            if (isset($arrayUsuario[0])) {
                $nombre = trim($arrayUsuario[0], "[]()");
                $telefonoSinFiltrar = trim($arrayUsuario[1]);

                $nombreApellidos = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $telefono = filter_var($telefonoSinFiltrar, FILTER_VALIDATE_INT);

                //Comprobar que no hay numeros de telefono repetidos
                if ($nombreApellidos != "" && $telefono != 0) {
                    if (
                        !isset($_SESSION['usuarios']) ||
                        (!array_key_exists($telefono, $_SESSION['usuarios'])
                            && !array_key_exists($telefono, $usuarios))
                    ) {
                        $_SESSION['usuarios'][$telefono] = $nombreApellidos;
                        $usuarioAgregado = true;
                    } else {
                        $errores[] = 'Teléfono repetido en los registros almacenados en la base de datos o en la sesión';
                    }
                } else {
                    $errores[] = 'Información introducida inválida';
                }
            }
        }
    } else {
        $errores[] = "Error en el formato de los datos introducidos";
    }
}


//En caso de querer eliminar el telefono seleccionado
if (isset($_POST['eliminar']) && $_POST['eliminar'] == "Eliminar seleccionados") {
    $telefonosAEliminar = filter_input(INPUT_POST, 'telefonosAEliminar', FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);

    if (!empty($telefonosAEliminar)) {
        foreach ($telefonosAEliminar as $telefonoAEliminar) {
            // Compruebo si la key es numérica
            if (is_numeric($telefonoAEliminar)) {
                unset($_SESSION['usuarios'][$telefonoAEliminar]);
            }
        }

        $usuariosEliminados = true;
    }
}

//En caso de querer guardar los datos almacenados
if (isset($_POST['guardar']) && $_POST['guardar'] == "Guardar") {
    foreach ($_SESSION['usuarios'] as $key => $usuario) {
        guardar_usuario($con, ["nombre" => $usuario, "telefono" => $key]);
    }
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
    <h1>Bienvenido al sistema de gestión de teléfonos</h1>

    <?php if (!empty($_SESSION['usuarios'])) : ?>
        <h2>Información introducida en la sesión:</h2>
        <form action="" method="post">
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
                                <input type="checkbox" name="telefonosAEliminar[]" value="<?= $key ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <input type="submit" value="Eliminar seleccionados" name="eliminar">
            <input type="submit" value="Guardar" name="guardar">
        </form>
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