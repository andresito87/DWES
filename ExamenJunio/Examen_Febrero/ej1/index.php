<?php
/* 
   DNI:
   NOMBRE y APELLIDOS: 
*/

require_once "./funciones.php";
$estados = obtenerEstadosAnimo();
//var_dump($estados);
//echo obtenerMensajeAnimo("Feliz");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <form action="" method="post">
        <select name="estado" id="estadoAnimo">
            <?php if ($estados) : ?>
                <?php foreach ($estados as $estado) : ?>
                    <option value="<?= $estado ?>"><?= $estado ?></option>
                <?php endforeach ?>
            <?php endif ?>
        </select><BR>
        <input type="submit" value="¡Enviar!">
    </form>
    <?php if (isset($_POST['estado'])) {
        echo obtenerMensajeAnimo($_POST['estado']);
    }
    ?>

</body>

</html>