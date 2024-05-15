<?php

try{
    $pdo=new PDO('mysql:dbname=localhost;port=3306;dbname=ejemplo_ex_20232024','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $ex)
{
    die(json_encode(['ERROR'=>"Error: no se pudo conectar"],JSON_PRETTY_PRINT));
}

