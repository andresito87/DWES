<?php

require_once 'conf.php';

$ver=$_GET['ver']??null;



//Si no se ha especificado $_GET['ver'] hemos que $ver tenga el "link" de la sección por defecto
if (is_null($ver) || empty($ver))
{
    //Buscamos la posición del array $secciones donde está el nombre de sección por defecto
    $posSeccionDefecto=array_search(SECCION_DEFECTO,array_column($secciones,'nombre'));
    if ($posSeccionDefecto!==false)
        $ver=$secciones[$posSeccionDefecto]['link'];
}
//$seccion = sección a mostrar
if (is_string($ver) && ($pos=array_search($ver,array_column($secciones,'link')))!==false)
{
    $seccion=$secciones[$pos];
}

/*************** TAREA 3  ******************/

//Función para calcular el HASH 
function calcularHash($data) {
    //En vez de usar hash_hmac se podría haber usado hash directamente
    return hash_hmac('sha256',$data,SALT); 
};

// Obtengo de forma segura el contenido de las cookies
$lista=$_COOKIE['lista_ultimos_sitios']??null;
$lista_hash=$_COOKIE['hash_lista_ultimos_sitios']??null;

// Deserializo la lista de sitios si es integra y si existe
if (is_null($lista) || is_null($lista_hash) || $lista_hash!==calcularHash($lista)) $lista=[];
else $lista=unserialize($lista);

//Si hay una sección a mostrar, se añade a la lista
if (isset($seccion))
{       
    $datosSitioVisitado=[$seccion['link'],$seccion['nombre'],time()];
    //Si el sitio ya está en la lista de visitados
    if (($pos=array_search($datosSitioVisitado[0],array_column($lista,'0')))!==false)
    {
        //Lo elimino de la lista (para después ponerlo primero)
        array_splice($lista,$pos,1);    
    }
    //Lo añado al principio
    array_unshift($lista,$datosSitioVisitado);
    //Elimino si hay más de 5
    array_splice($lista,LAST_VISITED_MAX);
}

setcookie('lista_ultimos_sitios',serialize($lista),time()+3600);
setcookie('hash_lista_ultimos_sitios',calcularHash(serialize($lista)),time()+3600);

/*************** FIN TAREA 3  ******************/

//TODO: 
// 1.- obtener las cookies y verificar que no ha sido modificada (calcular hash)
// 2.- deserializar la cookie con la listad e sitios visitados.
// 3.- añadir la seccion recien visitada sin duplicados (usa la función time() para el momento de acceso), insertando el primero en la cookie
// 4.- envia la cookie y el hash
// 5.- en footer.php, muestra la lista de sitios visitados y la fecha en orden cronológico.

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


//Buscamos el texto de "link" almacenado en $ver en las secciones y extraemos el archivo o contenido
if (isset($seccion))
{
    if (isset($seccion['contenido']))
    {
        $longitud=strlen($seccion['contenido']);
        echo $seccion['contenido'];
    }
    else if (isset($seccion['archivo']) && file_exists($seccion['archivo']))
    {
        readfile($archivo=$seccion['archivo']);
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