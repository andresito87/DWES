<?php
require_once 'src/conn.php';
require_once 'src/dbfuncs.php';

$pdo = connect();
try {
    $usuarios = usuarios($pdo, true, '');
} catch (PDOException $e) {
    $error = $e->getMessage();
    echo "Error:. $error";
    die();
}

/*Los datos recibidos de este formulario deberás procesarlos con con la función filter_input 
de forma adecuada. Si son válidos y tienen un valor correcto, serán usados para que 
la función usuarios retorne los usuarios señalados. Es importante que compruebes 
y verifiques de forma adecuada si los datos recibidos vía $_POST son los esperados.*/
if (isset($_POST['filtrar'])) {
    $filtro = filter_input(INPUT_POST, 'filtro', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
    $checkbox = filter_input(INPUT_POST, 'checkbox', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
    if (isset($_POST['checkbox']) && $_POST['checkbox'] == 'on') {
        $usuarios = usuarios($pdo, false, $filtro);
    } else {
        $usuarios = usuarios($pdo, true, $filtro);
    }
} else if (isset($_POST['checkbox'])) {
    $checkbox = filter_input(INPUT_POST, 'checkbox', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
    if ($_POST['checkbox'] == 'on') {
        $usuarios = usuarios($pdo, false, '');
    } else {
        $usuarios = usuarios($pdo, true, '');
    }
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
        <h3>Mostrar usuarios inactivos:
            <input type="checkbox" name="checkbox">(si no se marca, se mostrarán los usuarios activos)
        </h3>
        <label for="busqueda">Filtrar usuarios:</label>
        <input type="text" name="filtro" id="filtro" placeholder="Nombre y Apellidos">
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
    <th>Acciones</th>
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

    if (is_array($usuarios) && !empty($usuarios))
        foreach ($usuarios as $usuario) {
            echo "<tr>";
            echo "<td>" . $usuario['id'] . "</td>";
            echo "<td>" . $usuario['dni'] . "</td>";
            echo "<td>" . $usuario['fnacim'] . "</td>";
            echo "<td>" . $usuario['nombre'] . "</td>";
            echo "<td>" . $usuario['apellidos'] . "</td>";
            echo '<td><form id="form_' . $usuario['id'] . '" action="detalleusuario.php" method="post">
                <input type="hidden" name="idDetalleUsuario" value="' . $usuario['id'] . '"/>
                <input type="submit" class="inputDetalle" value="Ver Detalle" name="detalle"/>
              </form></td>';
            echo "</tr>";
        } else {
        echo "<tr>";
        echo "<td colspan='6'>No hay ninguna coincidencia con \"<span>$filtro</span>\"</td>";
        echo "</tr>";
    }

    ?>
    </tbody>
</table>
</body>
</html>
