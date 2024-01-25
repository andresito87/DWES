<?php
/*5. Escribe un script PHP que utilice `readfile` para mostrar el contenido de un archivo de texto.*/

$cantidadBytes=readfile("archivo.txt");
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lector de contenido de archivos</title>
</head>
<body>
<br>
<?php
if ($cantidadBytes==false){
    echo "No se ha podido leer el archivo";
}
else{
    echo "El archivo tiene $cantidadBytes bytes.";
}
?>
</body>
</html>
