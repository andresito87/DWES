<?php
/*13. Crea un array asociativo en PHP y muestra su contenido en una estructura de tabla HTML.*/

$array = array(
    array('nombre' => "Andrés",
        'apellidos' => "Podadera Gonzalez",
        'edad' => 34)
);
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio 13</title>
</head>
<body>
<?php if (!empty($array)): ?>
    <table border="1">
        <thead>
        <tr>
            <td>Nombre</td>
            <td>Apellidos</td>
            <td>Edad</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($array as $value): ?>
            <tr>
                <td><?= $value['nombre']; ?></td>
                <td><?= $value['apellidos']; ?></td>
                <td><?= $value['edad']; ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>
</body>
</html>
