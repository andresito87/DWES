<?php

try 
{
    $conn=new PDO('mysql:dbname=dwes_prueba;host=localhost','root','');
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException)
{

    die('<H1>ERROR: Imposible conectar con la base de datos</H1>');
}

return $conn;