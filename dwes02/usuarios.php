<?php
require_once 'src/conn.php';
require_once 'src/dbfuncs.php';

try {
    $pdo = connect();
    $usuarios = usuarios($pdo, true, '');
} catch (PDOException $e) {
    $error = $e->getMessage();
    echo "Error:. $error";
    die();
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Document</title>
</head>
<body>
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

    foreach ($usuarios as $usuario) {
        echo "<tr>";
        echo "<td>" . $usuario['id'] . "</td>";
        echo "<td>" . $usuario['dni'] . "</td>";
        echo "<td>" . $usuario['fnacim'] . "</td>";
        echo "<td>" . $usuario['nombre'] . "</td>";
        echo "<td>" . $usuario['apellidos'] . "</td>";
        echo "<td><button href='editar.php?id=" . $usuario['id'] . "'>Ver Detalles</button></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>
