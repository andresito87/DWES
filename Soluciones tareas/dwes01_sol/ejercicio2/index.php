<?php

require_once 'conf.php';

$ver=$_GET['ver']??null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1. Tarea 1. </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php require 'header.php'; ?>
<div>

<?php

//Si no se ha especificado $_GET['ver'] hemos que $ver tenga el "link" de la sección por defecto
if (is_null($ver) || empty($ver))
{
    //Buscamos la posición del array $secciones donde está el nombre de sección por defecto
    $posSeccionDefecto=array_search(SECCION_DEFECTO,array_column($secciones,'nombre'));
    if ($posSeccionDefecto!==false)
        $ver=$secciones[$posSeccionDefecto]['link'];
}

//Buscamos el texto de "link" almacenado en $ver en las secciones y extraemos el archivo o contenido
if (is_string($ver) && ($pos=array_search($ver,array_column($secciones,'link')))!==false)
{
    if (isset($secciones[$pos]['contenido']))
    {
        $longitud=strlen($secciones[$pos]['contenido']);
        echo $secciones[$pos]['contenido'];
    }
    else if (isset($secciones[$pos]['archivo']) && file_exists($secciones[$pos]['archivo']))
    {
        readfile($archivo=$secciones[$pos]['archivo']);
    }
} 
elseif ($ver)
{
    echo 'Sección <em>"'.htmlentities($ver).'"</em> no encontrada.';
}

?>
</div>
<?php require 'footer.php'; ?>
</body>
</html>