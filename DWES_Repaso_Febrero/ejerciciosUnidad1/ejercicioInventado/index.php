<?php
$arrayContenidos = [];
$arrayContenidos[] = ['nombre' => 'Pagina1', 'link' => 'pagina1.txt', 'imagen' => './imagenes/imagen1.png'];
$arrayContenidos[] = ['nombre' => 'Pagina2', 'link' => 'pagina2.txt', 'imagen' => './imagenes/imagen2.png'];


if (!isset($_GET['ver'])) {
    $ver = $arrayContenidos[0]['link'];
} else
    $ver = $_GET['ver'];
//echo "Link" . $ver;

$contenido = null;
//Busco el primer elemento del array en el que el valor de link coincida con el valor que me viene en el Get
foreach ($arrayContenidos as $key => $value) {
    if ($value['link'] === $ver) {
        $contenido = $key;
        break;
    }
}

//Si lo encuentro lo guardo
if ($contenido !== null) {
    $contenidoNombre = $arrayContenidos[$contenido]['nombre'];
    $contenidoImagen = $arrayContenidos[$contenido]['imagen'];

    echo "Nombre" . $contenidoNombre;
    echo "Imagen" . $contenidoImagen;
} else { //Sino muestro un mensaje de que no ha sido encontrado
    echo "No se encontró el contenido";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir contenido</title>
</head>

<body>
    <?php require "header.php";
    readfile($ver);
    ?>
    <p><img src="<?php
                    echo $contenidoImagen;
                    ?>"></p>

    <?php require "footer.php"; ?>