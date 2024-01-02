<?php
//Hago un require de footer.php para poder evitar el warning que generaría el uso de echo
//en este archivo antes de setear las cookies en footer.php
//He podido corregirlo gracias a desplegar la aplicación en un contenedor de Docker, 
//en Xampp no se mostraba el warning, demasiado permisivo con los errores
$contenido_html = require_once "footer.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link media="screen" rel="stylesheet" href="./assets/estilos.css">
    <title>Respira -
        <?php
        require_once "conf.php";
        // Se incluye el título de la sección seleccionada
        if (isset($_GET["ver"])) {
            foreach ($secciones as $seccion) {
                if ($seccion["link"] === $_GET["ver"]) {
                    echo $seccion["nombre"];
                }
            }
        } else {
            // Si no se ha seleccionado ninguna sección, se muestra la primera(Inicio)
            echo $secciones[0]["nombre"];
        }
        ?>
    </title>
</head>

<body>
    <header>
        <!-- Se incluye el header-->
        <?php
        require_once "header.php";
        ?>
    </header>
    <main>
        <!-- Se incluye el contenido de la sección seleccionada -->
        <?php
        if (isset($_GET["ver"])) {
            $seccion_encontrada = false;
            foreach ($secciones as $seccion) {
                if ($seccion["link"] === $_GET["ver"]) {
                    readfile("contenidos/" . $seccion["archivo"]);
                    $seccion_encontrada = true;
                    $archivo_html = "contenidos/" . $seccion["archivo"];
                    break;
                }
            }
            //si se modifica el parámetro ver y no se encuentra la sección, se muestra la primera por defecto
            if (!$seccion_encontrada) {
                header("Location: index.php?ver=" . urlencode($secciones[array_search(SECCION_DEFECTO, $secciones)]["link"]));
            }
        } else {
            // Si no se ha seleccionado ninguna sección, se muestra la primera(Inicio)
            readfile("contenidos/" . $secciones[0]["archivo"]);
            $archivo_html = "contenidos/" . $secciones[0]["archivo"];
        }
        ?>
    </main>
    <footer>
        <!-- Se incluye el footer -->
        <?php
        echo $contenido_html;
        ?>
        </p>
    </footer>
</body>

</html>