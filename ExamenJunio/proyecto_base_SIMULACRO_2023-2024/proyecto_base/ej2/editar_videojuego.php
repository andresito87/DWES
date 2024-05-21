<!DOCTYPE html>
<html lang='es'>

<head>
  <meta charset='utf-8' />
  <title>Eliminar vivienda</title>
</head>

<?php
require_once ('conexion_bbdd.php');
$resultado = '';
$SQL = "UPDATE videojuegos SET titulo=:titulo, desarrollador=:desarrollador, anio_publicacion=:anio_publicacion WHERE id=:id";
try {
  $stmt = $pdo->prepare($SQL);
  $stmt->bindValue('id', 3);
  $stmt->bindValue('titulo', 'God of War');
  $stmt->bindValue('desarrollador', 'Santa Monica Studio');
  $stmt->bindValue('anio_publicacion', 2018);
  if ($stmt->execute()) {
    $resultado = $stmt->rowCount();
  }
} catch (PDOException $ex) {
  var_dump($ex);
}

?>

<body>
  <h1>Editar videojuego</h1>
  <?php if ($resultado == 1) : ?>
    <p>El videojuego con identificador 3 ha sido editado correctamente.</p>
  <?php else : ?>
    <p>El videojuego con identificador 3 no ha sido editado correctamente.</p>
  <?php endif ?>
</body>

</html>