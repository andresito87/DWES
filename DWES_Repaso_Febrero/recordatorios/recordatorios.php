<?php
/*Recordatorios (para practicar: uso de base de datos)
En este ejercicio vamos a implementar un pequeño sistema de recordatorios. Es decir, un sistema que permita almacenar un recordatorio
 hasta una fecha tope, con un título y detalles sobre el recordatorio. Por ejemplo, podríamos poner un recordatorio como el siguiente:

- recordar hasta: 25/01/2023 12:33
- titulo: pedir cita para el veterinario
- detalles: Es para la vacunación, no olvides llevar la cartilla para que anote la vacuna.

El sistema debería permitir implementar lo siguiente:

- Añadir un recordatorio (fecha y hora hasta la que recordar, titulo, detalle).
- Ver recordatorios no caducados y caducados. 
- Borrar un recordatorio existente.
- Modificar un recordatorio seleccionado (solo no caducados).

La base de datos a usar será la siguiente:

CREATE TABLE recordatorios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recordar_hasta DATETIME NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    detalle TEXT
);*/

require_once('funciones.php');
$con = require_once('conexion_BD.php');

if (isset($_POST['modificar'])) {
    $id = filter_input(INPUT_POST, 'id');
    $datos_recordatorio = obtener_recordatorio($con, $id);
}
if (isset($_POST['eliminar'])) {
    $id = filter_input(INPUT_POST, 'id');
    eliminar_recordatorio($con, $id);
}

if (isset($_POST['enviar']) && isset($_POST['id']) && $_POST['id'] == "") {
    $errores = [];
    $recordar_hasta = filter_input(INPUT_POST, 'recordar_hasta');
    $recordar_hasta = DateTime::createFromFormat('Y-m-d', $recordar_hasta);
    if (!$recordar_hasta || $recordar_hasta::getLastErrors()['warning_count'] != 0 || $recordar_hasta::getLastErrors()['error_count'] != 0) {
        $errores[] = "Error en la fecha introducida";
    }

    $titulo = filter_input(INPUT_POST, 'titulo');
    if ($titulo == null) {
        $errores[] = "El titulo está vacío";
    }

    $detalle = filter_input(INPUT_POST, 'detalle');

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if (empty($errores)) {
        $recordatorio['id'] = $id;
        $recordatorio['recordar_hasta'] =
            $recordar_hasta->format('Y-m-d'); //Convertir objeto DateTime a cadena
        $recordatorio['titulo'] = $titulo;
        $recordatorio['detalle'] = $detalle;

        agregar_recordatorio($con, $recordatorio);
    } else {
        var_dump($errores);
    }
}
if (isset($_POST['enviar']) && isset($_POST['id']) && $_POST['id'] == "") {
    if (!empty($id) && $id != null) {
        actualizar_recordatorio($con, $recordatorio);
    }
}

$recordatorios = obtener_recordatorios($con);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recordatorios</title>
</head>

<body>
    <?php if (!empty($recordatorios)) : ?>
        <table border="1">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Recordar hasta</td>
                    <td>Titulo</td>
                    <td>Detalle</td>
                    <td>Modificar</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recordatorios as $key => $values) : ?>
                    <tr>
                        <td><?= isset($values['id']) ? $values['id'] : '' ?></td>
                        <td><?= isset($values['recordar_hasta']) ? $values['recordar_hasta'] : '' ?></td>
                        <td><?= isset($values['titulo']) ? $values['titulo'] : '' ?></td>
                        <td><?= isset($values['detalle']) ? $values['detalle'] : '' ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" value="<?= isset($values['id']) ? $values['id'] : '' ?>" name="id">
                                <input type="submit" value="Modificar" name="modificar">
                            </form>
                            <form action="" method="post">
                                <input type="hidden" value="<?= isset($values['id']) ? $values['id'] : '' ?>" name="id">
                                <input type="submit" value="Eliminar" name="eliminar">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <form action="" method="post">
        <label for="recordar_hasta">Recordar hasta: <input type="text" name="recordar_hasta" id="recordar_hasta" value="<?= isset($datos_recordatorio['recordar_hasta']) ? DateTime::createFromFormat('Y-m-d H:m:s', $datos_recordatorio['recordar_hasta'])->format('Y-m-d') : "" ?>"><br>
            <label for="titulo">Título: <input type="text" name="titulo" id="titulo" value="<?= isset($datos_recordatorio['titulo']) ? $datos_recordatorio['titulo'] : "" ?>"></label><br>
            <label for="detalles">Detalles: <input type="text" name="detalle" id="detalle" value="<?= isset($datos_recordatorio['detalle']) ? $datos_recordatorio['detalle'] : "" ?>">
                <input type="hidden" name="id" id="id" value="<?= isset($datos_recordatorio['id']) ? $datos_recordatorio['id'] : "" ?>"></label><br>
            <input type="submit" value="Enviar" name="enviar">
    </form>
</body>

</html>