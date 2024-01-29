<?php
$posiciones = [];

session_start();

if (isset($_POST['op'])) {
    unset($_SESSION['posiciones']);
    header("Location: index.php");
} else if (isset($_POST['marcar']) && isset($_POST['x']) && $_POST['x'] != '' && isset($_POST['y']) && $_POST['y'] != '') {
    $x = filter_input(INPUT_POST, 'x', FILTER_VALIDATE_INT);
    $y = filter_input(INPUT_POST, 'y', FILTER_VALIDATE_INT);
    if ($x === false || $y === false) {
        $mensaje = "Posición no válida";
        $posiciones = $_SESSION['posiciones'];
    } else if ($x < 0 || $x > 9 || $y < 0 || $y > 9) {
        $mensaje = "Posición fuera de rango";
        $posiciones = $_SESSION['posiciones'];
    } else {
        $pos = $x . '-' . $y;
        if (!in_array($pos, $_SESSION['posiciones'])) {
            $_SESSION['posiciones'][] = $pos;
            $mensaje = "Posición marcada";
        } else {
            $mensaje = "Posición ya marcada";
        }
        $posiciones = $_SESSION['posiciones'];
    }
} else if (isset($_POST['marcar']) && (isset($_POST['x']) && $_POST['x'] == '')) {
    $mensaje = "Posición x no introducida";
    $posiciones = $_SESSION['posiciones'];
} else if (isset($_POST['marcar']) && (isset($_POST['y']) && $_POST['y'] == '')) {
    $mensaje = "Posición y no introducida";
    $posiciones = $_SESSION['posiciones'];
} else if (isset($_SESSION['posiciones'])) {
    $posiciones = $_SESSION['posiciones'];
} else {
    $_SESSION['posiciones'] = $posiciones;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <style>
        td {
            border: 1px solid green;
            min-width: 30px;
            height: 30px;
            text-align: center;
            vertical-align: middle;
        }

        .blue {
            background-color: lightblue;
        }
    </style>
</head>

<body>
    <?php
    if (isset($mensaje)) : ?>
        <h2>
            <?= $mensaje ?>
        </h2>
    <?php endif; ?>
    <table>

        <tr>
            <th></th>
            <?php for ($x = 0; $x < 10; $x++) : ?>
                <th>
                    <?= $x ?>
                </th>
            <?php endfor; ?>
        </tr>
        <?php for ($y = 0; $y < 10; $y++) : ?>
            <tr>
                <th>
                    <?= $y ?>
                </th>
                <?php
                for ($x = 0; $x < 10; $x++) :
                    if (in_array($x . '-' . $y, $posiciones))
                        $class = 'blue';
                    else
                        $class = '';
                ?>
                    <td class='<?= $class ?>'>
                        <?= $class ? "x" : "" ?>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
    <form action="" method="post">
        <label for="x">Posicion x: <input type="text" name="x" id="x"></label><br>
        <label for="y">Posicion y: <input type="text" name="y" id="x"></label><br>
        <input type="submit" value="Marcar" name="marcar">
    </form>
    <form action="" method="post">
        <input type="hidden" name="op" value="limpiar">
        <input type="submit" value="Limpiar Tablero">
    </form>
</body>

</html>