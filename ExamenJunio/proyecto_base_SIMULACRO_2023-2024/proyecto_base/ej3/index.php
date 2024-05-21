<?php

//Datos de los desarrolladores disponibles
$desarrolladores = [
    "Bungie",
    "Hidetaka Miyazaki",
    "Infinity Ward",
    "Ken Levine",
    "Markus Persson",
    "Nintendo",
    "Patrice Désilets",
    "Rockstar North",
    "Todd Howard",
    "Valve Corporation"
];

session_start();
if (isset($_POST['desarrollador']) && ! empty($_POST['desarrollador']) && ! (in_array($_POST['desarrollador'], $desarrolladores) || $_POST['desarrollador'] == 'otro')) {
    echo "ERROR:desarrrollador no esperado";
}
if (isset($_POST['desarrollador']) && ! empty($_POST['desarrollador']) && (in_array($_POST['desarrollador'], $desarrolladores) || $_POST['desarrollador'] == 'otro')) {
    $_SESSION['datos']['desarrollador'] = filter_input(INPUT_POST, 'desarrollador', FILTER_SANITIZE_SPECIAL_CHARS);
}

if (isset($_POST['desarrollador_otro']) && ! empty($_POST['desarrollador_otro']) && strlen($_POST['desarrollador_otro']) > 2) {
    $_SESSION['datos']['desarrollador'] = filter_input(INPUT_POST, 'desarrollador_otro', FILTER_SANITIZE_SPECIAL_CHARS);
}

if (isset($_POST['anio_publicacion']) && ! empty($_POST['anio_publicacion']) && intval($_POST['anio_publicacion']) > 1950) {
    $_SESSION['datos']['anio_publicacion'] = filter_input(INPUT_POST, 'anio_publicacion', FILTER_VALIDATE_INT);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>

<body>

    <form action="" method="post">
        <label for="desarrollador">
            Selecciona el desarrollador:
            <select name="desarrollador" id="desarrollador">
                <option value="Bungie">Bungie</option>
                <option value="Hidetaka Miyazaki">Hidetaka Miyazaki</option>
                <option value="Infinity Ward">Infinity Ward</option>
                <option value="Ken Levine">Ken Levine</option>
                <option value="Markus Persson">Markus Persson</option>
                <option value="Nintendo">Nintendo</option>
                <option value="Patrice Désilets">Patrice Désilets</option>
                <option value="Rockstar North">Rockstar North</option>
                <option value="Todd Howard">Todd Howard</option>
                <option value="Valve Corporation">Valve Corporation</option>
                <option value="otro">Otro desarrollador</option>
                <option value="<?= uniqid(); ?>">DATO ERRÓNEO ALEATORIO</option>
            </select>
        </label>
        <input type="submit" value="Comenzar!">
    </form>
    <?php if (isset($_SESSION['datos']['desarrollador']) && $_SESSION['datos']['desarrollador'] == 'otro') : ?>
        <form action="" method="post">
            <label for="desarrollador_otro">
                Indique el nombre del desarrollador: <input type="text" name="desarrollador_otro" id="desarrollador_otro">
            </label>
            <input type="submit" value="Enviar!">
        </form>
    <?php endif ?>

    <?php if (isset($_SESSION['datos']['desarrollador']) && $_SESSION['datos']['desarrollador'] != 'otro' && ! isset($_SESSION['datos']['anio_publicacion'])) : ?>
        <form action="" method="post">
            <label for="anio_publicacion">
                Indique el año de publicación: <input type="text" name="anio_publicacion" id="anio_publicacion">
            </label>
            <input type="submit" value="Enviar!">
        </form>
    <?php endif ?>

    <?php if (isset($_SESSION['datos']['desarrollador']) && $_SESSION['datos']['desarrollador'] != 'otro' && isset($_SESSION['datos']['anio_publicacion'])) {
        var_dump($_SESSION['datos']);
        unset($_SESSION['datos']);
    }
    ?>
</body>

</html>