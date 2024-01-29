<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' lang='es'>

<head>
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=2.0' />
  <style>
    body {
      max-width: 210mm;
      margin: 0 auto;
      padding: 0 1em;
      font-family: 'Segoe UI', 'Open Sans', sans-serif
    }

    a {
      text-decoration: none;
      color: blue
    }

    h1 {
      text-align: center;
      margin-top: 0
    }

    nav,
    footer {
      text-align: center
    }
  </style>
  <title>Películas</title>
</head>

<body>
  <h1>Películas</h1>

  <nav><a href='index.php'>Inicio</a> | Editar</nav>

  <h2>Editar</h2>

  <!-- Completa aquí el código -->
  <?php
  require './connect_db.php';

  if (isset($_POST['editar'])) {
    function actualizar_datos_pelicula(PDO $pdo, $datos_pelicula): array|int
    {
      $sql = <<<ENDSQL
        UPDATE peliculas SET titulo=:titulo, fecha_estreno=:fecha_estreno, duracion=:duracion, genero=:genero, director=:director where id=:id
        ENDSQL;
      $ret = false;
      try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $datos_pelicula['id']);
        $stmt->bindValue(':titulo', $datos_pelicula['titulo']);
        $stmt->bindValue(':fecha_estreno', $datos_pelicula['fecha_estreno']);
        $stmt->bindValue(':duracion', $datos_pelicula['duracion']);
        $stmt->bindValue(':genero', $datos_pelicula['genero']);
        $stmt->bindValue(':director', $datos_pelicula['director']);
        if ($stmt->execute()) {
          $ret = $stmt->rowCount();
        }
      } catch (PDOException $ex) {
        var_dump($ex);
        $ret = -1;
      }
      return $ret;
    }
    $conexion_DB = connect();
    $datos_actualizados = actualizar_datos_pelicula($conexion_DB, $_POST);
    $conexion_DB = null;
  }

  if ($datos_actualizados == 1) {
    echo "Datos actualizados correctamente.";
  } else {
    echo "Hubo un problema en la actualización.";
  }

  ?>

  <footer>
    <p>Examen de febrero - Desarrollo Web en Entorno Servidor a distancia - 2022-2023.</p>
  </footer>

</body>

</html>