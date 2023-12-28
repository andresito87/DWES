<?php
require_once __DIR__ . '/src/conn.php';
require_once __DIR__ . '/src/dbfuncs.php';
require_once __DIR__ . '/session_control.php';
require_once __DIR__ . '/src/userauth.php';
require_once __DIR__ . '/extra/header.php';


//comprobamos si el rol del usuario es admin, coordinador, trabajador social o educador social
$mostrar_boton_ver_detalle = false;
if (verificacion_rol_de_sesion('admin') || verificacion_rol_de_sesion('coord') || verificacion_rol_de_sesion('trasoc') || verificacion_rol_de_sesion('edusoc')) {
    if (verificacion_rol_de_sesion('admin') || verificacion_rol_de_sesion('coord') || verificacion_rol_de_sesion('trasoc')) {
        $mostrar_boton_ver_detalle = true;
    }
    //Conexión a la base de datos y recuperación de los usuarios
    $pdo = connect();
    try {
        $usuarios = usuarios($pdo, true, '');
    } catch (PDOException $e) {
        $error = $e->getMessage();
        die("Error:. $error");
    }

    //Verificacion y filtrado de datos
    $filtro = "";
    $checkbox = true;
    if (isset($_POST['filtrar'])) {
        $filtro = trim(filter_input(INPUT_POST, 'filtro', FILTER_SANITIZE_SPECIAL_CHARS));
        $checkbox = filter_input(INPUT_POST, 'checkbox', FILTER_SANITIZE_SPECIAL_CHARS);
        if (is_string($checkbox) && $checkbox == 'on' && !empty($filtro)) {
            $usuarios = usuarios($pdo, false, $filtro);
            $checkbox = false;
        } else if (is_string($checkbox) && $checkbox == 'on' && empty($filtro)) {
            $usuarios = usuarios($pdo, false, '');
            $checkbox = false;
        } else if (is_string($checkbox) && $checkbox != 'on' && !empty($filtro)) {
            $usuarios = usuarios($pdo, true, '');
        } else {
            $usuarios = usuarios($pdo, true, $filtro);
        }
        $_SESSION['filtro'] = $filtro;
        $_SESSION['checkbox'] = $checkbox;
    } else if (isset($_SESSION['filtro']) && isset($_SESSION['checkbox'])) {
        $usuarios = usuarios($pdo, $_SESSION['checkbox'], $_SESSION['filtro']);
    } else if (!isset($_SESSION['filtro']) && isset($_SESSION['checkbox'])) {
        $usuarios = usuarios($pdo, $_SESSION['checkbox'], '');
    } else if (isset($_SESSION['filtro']) && !isset($_SESSION['checkbox'])) {
        $usuarios = usuarios($pdo, true, $_SESSION['filtro']);
    } else {
        $usuarios = usuarios($pdo, true, '');
    }
    $pdo = null;
    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="./styles/estilosListadoUsuarios.css">
        <title>Listado de Usuarios</title>
    </head>

    <body>
        <div class="filtroDatos">
            <h2>Filtrar datos</h2>
            <form action="usuarios.php" method="post">
                <label for="checkbox">Mostrar usuarios inactivos:</label>
                <input type="checkbox" id="checkbox" name="checkbox">(si no se marca, se mostrarán los usuarios activos)
                <br>
                <label for="busqueda">Filtrar usuarios:</label>
                <input type="text" id="busqueda" name="filtro" placeholder="Nombre y Apellidos">
                <br>
                <input type="submit" value="¡Filtrar!" name="filtrar">
            </form>
        </div>
        <br>
        <br>
        <h1>Usuarios asociación Respira</h1>
        <table>
            <thead>
                <th>ID</th>
                <th>DNI</th>
                <th>Fecha de Nacimiento</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <?php
                if ($mostrar_boton_ver_detalle) {
                    echo "<th>Acciones</th>";
                }
                ?>
            </thead>
            <tbody>
                <?php

                /* Con While y fetch:
                while ($usuario = $usuarios->fetch(PDO::FETCH_ASSOC)) {
                     echo "<tr>";
                     echo "<td>" . $usuario['id'] . "</td>";
                     echo "<td>" . $usuario['dni'] . "</td>";
                     echo "<td>" . $usuario['fnacim'] . "</td>";
                     echo "<td>" . $usuario['nombre'] . "</td>";
                     echo "<td>" . $usuario['apellidos'] . "</td>";
                     echo '<td><form id="form" action="detalleusuario.php" method="post">
                             <input type="hidden" name="id" value="' . $usuario['id'] . '"/>
                             <input type="submit" class="inputDetalle" value="Ver Detalle" name="detalle"/></td>';
                     echo "</tr>";
                 }*/

                // Con foreach: Mostar los usuarios en una tabla
                if (!empty($usuarios))
                    foreach ($usuarios as $usuario) {
                        echo "<tr>";
                        echo "<td>" . $usuario['id'] . "</td>";
                        echo "<td>" . $usuario['dni'] . "</td>";
                        echo "<td>" . $usuario['fnacim'] . "</td>";
                        echo "<td>" . $usuario['nombre'] . "</td>";
                        echo "<td>" . $usuario['apellidos'] . "</td>";
                        if ($mostrar_boton_ver_detalle) {
                            echo '<td><form id="form_' . $usuario['id'] . '" action="detalleusuario.php" method="post">
                <input type="hidden" name="idDetalleUsuario" value="' . $usuario['id'] . '"/>
                <input type="submit" class="inputDetalle" value="Ver Detalle" name="detalle"/>';
                        }
                        echo "</form></td>";
                        echo "</tr>";
                    } else {
                    $filtro = isset($_SESSION['filtro']) ? $_SESSION['filtro'] : $filtro;
                    echo "<tr>";
                    echo "<td colspan='6'>No hay ninguna coincidencia con \"<span>" . $filtro . "</span>\"</td>";
                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>
    </body>

    </html>
    <?php
} else {
    session_unset();
    header("Location: ./login.php"); // Redirigimos al usuario a la página de login
    exit;
}