<?php
// Configuración de la base de datos
$dsn = "mysql:host=localhost;dbname=testdb";
$username = "root";
$password = "";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);

try {
    // Conexión a la base de datos usando PDO
    $dbh = new PDO($dsn, $username, $password, $options);

    // Realiza la consulta SQL para obtener todos los registros de la tabla 'smartphones'
    $stmt = $dbh->query('SELECT * FROM smartphones');

    // Obtiene todos los resultados de la consulta en un array asociativo
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Itera sobre cada fila del array de resultados
    foreach ($rows as $row) {
        // Muestra los datos de cada smartphone en formato legible
        // htmlspecialchars se usa para evitar ataques XSS sanitizando la salida
        echo 'Marca: ' . htmlspecialchars($row['marca']) . ', Modelo: ' . htmlspecialchars($row['modelo']) . ', RAM: ' . htmlspecialchars($row['memoria_ram']) . ' GB, Almacenamiento: ' . htmlspecialchars($row['almacenamiento']) . ' GB.<br />';
    }
} catch (PDOException $e) {
    // Manejo de errores en caso de que la conexión o la consulta falle
    echo 'Error: ' . $e->getMessage();
}
?>