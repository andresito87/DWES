<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' lang='es'>
  <head>
    <meta charset='utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=2.0' />
    <style>body{max-width:210mm;margin:0 auto;padding:0 1em;font-family:'Segoe UI','Open Sans',sans-serif}a{text-decoration:none;color:blue}h1{text-align:center;margin-top:0}nav,footer{text-align:center}</style>
    <title>Smartphones</title>
  </head>

  <body>
    <h1>Smartphones</h1>

    <nav><a href='index.php'>Inicio</a> | <a href='ver.php'>Ver</a> | Filtrar</nav>

    <h2>Filtrar</h2>

    <?php

    require_once 'connect_db.php';

    $marca = addslashes($_POST['marca']??'');
    $ram = intval($_POST['ram']??0);
    $almacenamiento = intval($_POST['almacenamiento']??0);

    try {
        $query = 'SELECT * FROM smartphones WHERE marca LIKE ? AND memoria_ram = ? AND almacenamiento = ?';
        $stmt = $dbh->prepare($query);
        $stmt->execute(['%' . $marca . '%', $ram, $almacenamiento]);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo 'Marca: ' . $row['marca'] . ', Modelo: ' . $row['modelo'] . ', RAM: ' . $row['memoria_ram'] . ' GB, Almacenamiento: ' . $row['almacenamiento'] . ' GB.<br />';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    ?>

    <footer><p>Examen de febrero - Desarrollo Web en Entorno Servidor a distancia - 2023-2024.</p></footer>

  </body>
</html>
