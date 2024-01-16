<?php
require_once('./vars.php');
//Debes modificar este script para que se muestre el ganador, seleccionado (que es recibido por $_POST). Si no hay datos en $_POST debes mandar al usuario de vuelta a index.php
if (isset($_POST['seleccionar'])) {
  $ganador = $_POST['seleccionar'];
  $ganador = array_search('Seleccionar', $ganador);
  $ganadorNombre = $participantes[$ganador]['nombre'];
  $ganadorImagen = $participantes[$ganador]['imagen_url'];
} else {
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio 1: Candidatos finalistas</title>
  <style>

  </style>
</head>

<body>
  <h1>¡Enhorabuena a
    <?php
    echo $ganadorNombre;
    ?>
    !
  </h1>
  <p><img src="<?php
  echo $ganadorImagen;
  ?>"></p>

</body>

</html>