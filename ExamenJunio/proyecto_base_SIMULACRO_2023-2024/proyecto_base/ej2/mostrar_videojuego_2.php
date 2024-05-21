<!DOCTYPE html>
<html lang='es'>

<head>
  <meta charset='utf-8' />
  <title>Prueba Junio - BBDD</title>
</head>

<?php
require_once ('conexion_bbdd.php');
if (isset($_POST['id']) && ! empty($_POST['id'])) {
  $idVideojuego = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
  if ($idVideojuego) {
    $SQL = "SELECT * FROM videojuegos WHERE id=:id";
    $resultado = false;
    try {
      $stmt = $pdo->prepare($SQL);
      $stmt->bindValue('id', $idVideojuego);
      if ($stmt->execute())
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
      var_dump($ex);
    }
  }
}
?>

<body>
  <h1>Mostrar videojuego por ID</h1>

  <?php if (isset($resultado) && ! empty($resultado)) : ?>
    <ul>
      <li>ID: <?= $resultado['id'] ?></li>
      <li>Título: <?= $resultado['titulo'] ?></li>
      <li>Desarrollador: <?= $resultado['titulo'] ?></li>
      <li>Año de publicación: <?= $resultado['anio_publicacion'] ?></li>
    </ul>
  <?php else : ?>
    <p>No hay registros con ese id</p>
  <?php endif ?>
</body>

</html>