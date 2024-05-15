<?php
/* 
   DNI:
   NOMBRE y APELLIDOS: 

   */
require_once "./conf.php";

session_start();
if (! isset($_SESSION['recuento']))
    $_SESSION['recuento'] = [];

$texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$reiniciar = filter_input(INPUT_POST, 'reiniciar', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (is_string($texto)) {

    $palabras = preg_split('/[\s,.?¿\"\'!:;]+/', $texto);


    foreach ($palabras as $palabra) {
        foreach (PALABRAS as $key => $value) {
            $palabra = strtolower($palabra);
            if (in_array($palabra, $value)) {
                if (! isset($_SESSION['recuento'][$key]))
                    $_SESSION['recuento'][$key] = 0;
                $_SESSION['recuento'][$key]++;
            }
        }
    }
} elseif (is_string($reiniciar) && $reiniciar === 'si') {
    foreach ($_SESSION['recuento'] as $key => $value) {
        $_SESSION['recuento'][$key] = 0;
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>

<body>
    <form action="" method="post">
        Introduce tu texto:<br><textarea name="texto" id="" cols="30" rows="10"></textarea><BR>
        <input type="submit" value="¡Contar!">
    </form>
    <br><br>
    <form action="" method="post">
        <input type="hidden" name="reiniciar" value="si">
        <input type="submit" value="¡Reiniciar Recuento!">
    </form>
    <br><br>
    <H2>Recuento </H2>
    <?php foreach ($_SESSION['recuento'] as $keyRecuento => $valueRecuento) : ?>

        <?php echo "Aparecen " . $keyRecuento . " => " . $valueRecuento . " veces <BR>"; ?>

    <?php endforeach ?>
</body>

</html>