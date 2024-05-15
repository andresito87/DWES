<?php
/* 
   DNI:
   NOMBRE y APELLIDOS: 
*/
// Completa aquí el código


$host = 'localhost';
$dbname = 'examen_dwes_bbdd';
$username = 'root';
$password = '';

try {
   $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);

   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
   die('Error: ' . $e->getMessage());
}

?>