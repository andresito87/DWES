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

  if (isset($_POST['Enviar'])) {
    function obtener_datos_pelicula(PDO $pdo, $id): array|int
    {
      $sql = <<<ENDSQL
    SELECT id,titulo, fecha_estreno, duracion, genero, director FROM peliculas where id=:id;
    ENDSQL;
      $ret = false;
      try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $ret = $stmt->fetch(PDO::FETCH_ASSOC); //se usa fetch porque solo necesito un registro, no usar fetchAll en este caso
      } catch (PDOException $ex) {
        var_dump($ex);
        $ret = -1;
      }
      return $ret;
    }
    $conexion_DB = connect();
    $datos = obtener_datos_pelicula($conexion_DB, $_POST['pelicula_id']);
    $conexion_DB = null;
  ?>
    <form action="./editar_3.php" method="post">
      <label for="id">ID:
        <input type="text" id="id" name="datos[id]" value="<?php if (isset($datos) && isset($datos['id'])) echo $datos['id']; ?>">
      </label><br>
      <label for="titulo">Titulo:
        <input type="text" id="titulo" name="datos[titulo]" value="<?php if (isset($datos) && isset($datos['titulo'])) echo $datos['titulo']; ?>">
      </label><br>
      <label for="fecha_estreno">Fecha de estreno:
        <input type="text" id="fecha_estreno" name="datos[fecha_estreno]" value="<?php if (isset($datos) && isset($datos['fecha_estreno'])) echo $datos['fecha_estreno']; ?>">
      </label><br>
      <label for="duracion">Duración:
        <input type="text" id="duracion" name="datos[duracion]" value="<?php if (isset($datos) && isset($datos['duracion'])) echo $datos['duracion']; ?>">
      </label><br>
      <label for="genero">Genero:
        <input type="text" id="genero" name="datos[genero]" value="<?php if (isset($datos) && isset($datos['genero'])) echo $datos['genero']; ?>">
      </label><br>
      <label for="director">Director:
        <input type="text" id="director" name="datos[director]" value="<?php if (isset($datos) && isset($datos['director'])) echo $datos['director']; ?>">
      </label><br>
      <input type="submit" value="Editar" name="editar">
    </form>
  <?php

  }

  ?>

  <footer>
    <p>Examen de febrero - Desarrollo Web en Entorno Servidor a distancia - 2022-2023.</p>
  </footer>

</body>

</html>