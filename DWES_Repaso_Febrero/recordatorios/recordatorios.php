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

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$recordar_hasta = filter_input(INPUT_POST, 'recordar_hasta');
$titulo = filter_input(INPUT_POST, 'titulo');
$detalle = filter_input(INPUT_POST, 'detalle');
$accion = filter_input(INPUT_POST, 'accion');

//Para cargar los datos del registro a modificar
if (isset($_POST['accion'])) {
    $datos_recordatorio = obtener_recordatorio($con, $id);
}

$errores = [];
$recordar_hasta = DateTime::createFromFormat('d/m/Y H:i', $recordar_hasta);
if ($recordar_hasta == false || $recordar_hasta::getLastErrors()) {
    $errores[] = "Error en la fecha introducida";
}

if ($titulo == null) {
    $errores[] = "El titulo está vacío";
}

$detalle = filter_input(INPUT_POST, 'detalle');

if (
    isset($_POST['enviar']) && $_POST['enviar'] == "Enviar" &&
    !isset($_POST['id'])
) {
    if (empty($errores)) {
        $recordatorio['id'] = $id;
        $recordatorio['recordar_hasta'] =
            $recordar_hasta->format('Y-m-d H:i:s'); //Convertir objeto DateTime a cadena. Formato usado MySql
        $recordatorio['titulo'] = $titulo;
        $recordatorio['detalle'] = $detalle;
        agregar_recordatorio($con, $recordatorio);
    } else {
        echo "Errores:<br>";
        foreach ($errores as $key => $error) {
            echo $error . "<br>";
        }
    }
} else if (isset($_POST['modificar']) && $_POST['modificar'] == "Modificar") {
    $recordatorio['recordar_hasta'] = $_POST['recordar_hasta'];
    $recordatorio['titulo'] = $titulo;
    $recordatorio['detalle'] = $detalle;
    actualizar_recordatorio($con, $id, $recordatorio);
} else if (isset($_POST['accion']) && $_POST['accion'] == "eliminar") {
    eliminar_recordatorio($con, $id);
    header("Location: recordatorios.php");
}

//$recordatorios = obtener_recordatorios($con, true); //Recordatorios del pasado
$recordatorios = obtener_recordatorios($con); //Recordatorios del presente y futuro

?>

<!DOCTYPE html>
<html lang="es">

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
                    <td>Recordar hasta <strong>(Dia/Mes/Año Horas:Minutos)</strong></td>
                    <td>Titulo</td>
                    <td>Detalle</td>
                    <td>Modificar</td>
                    <td>Eliminar</td>
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
                                <input type="hidden" name="accion" value="modificar">
                                <input type="submit" value="Modificar">
                            </form>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" value="<?= isset($values['id']) ? $values['id'] : '' ?>" name="id">
                                <input type="hidden" name="accion" value="eliminar">
                                <input type="submit" value="Eliminar">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <form action="" method="post">
        <label for="recordar_hasta">Recordar hasta (Dia/Mes/Año Horas:Minutos): <input type="text" name="recordar_hasta" id="recordar_hasta" value="<?= isset($datos_recordatorio['recordar_hasta']) ? DateTime::createFromFormat('Y-m-d H:m:s', $datos_recordatorio['recordar_hasta'])->format('Y-m-d H:i') : "" ?>"><br>
            <label for="titulo">Título: <input type="text" name="titulo" id="titulo" value="<?= isset($datos_recordatorio['titulo']) ? $datos_recordatorio['titulo'] : "" ?>"></label><br>
            <label for="detalles">Detalles: <input type="text" name="detalle" id="detalle" value="<?= isset($datos_recordatorio['detalle']) ? $datos_recordatorio['detalle'] : "" ?>">
                <?php if (isset($_POST['accion'])) { ?>
                    <input type="hidden" name="id" id="id" value="<?php echo $_POST['id'] ?>"></label><br>
        <?php }
        ?>
        <input type="submit" value="<?php echo (isset($_POST['accion']) && $_POST['accion'] == "modificar") ? "Modificar" : "Enviar" ?>" name="<?php echo (isset($_POST['accion']) && $_POST['accion'] == "modificar") ? "modificar" : "enviar" ?>">
    </form>
</body>

</html>