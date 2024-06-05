<?php
$dsn = "mysql:host=localhost;dbname=test_db";
$username = "root";
$password = "";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>