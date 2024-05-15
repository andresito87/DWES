<?php

try{
    $pdo=new PDO('mysql:dbname=localhost;port=3306;dbname=ejemplo_ex_20232024','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} 
catch (PDOException $ex)
{
    var_dump($ex);
    die("Error: no se pudo conectar");
}

