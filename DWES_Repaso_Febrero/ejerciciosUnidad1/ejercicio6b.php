<?php
if(isset($_GET["nombre"]) && isset($_GET["apellido"]) && isset($_GET["edad"]) && isset($_GET["ciudad"])){
    $nombre = $_GET["nombre"];
    $apellido = $_GET["apellido"];
    $edad = $_GET["edad"];
    $ciudad = $_GET["ciudad"];
    echo "Nombre: $nombre<br>";
    echo "Apellido: $apellido<br>";
    echo "Edad: $edad<br>";
    echo "Ciudad: $ciudad<br>";
}
else{
    echo "No se han recibido los datos esperados";
}