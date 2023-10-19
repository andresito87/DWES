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
        require "header.php";
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
                    break;
                }
            }
            //si se modifica el parámetro ver y no se encuentra la sección, se muestra la primera
            if (!$seccion_encontrada) {
                header("Location: index.php?ver=sección+1");
            }
        } else {
            // Si no se ha seleccionado ninguna sección, se muestra la primera(Inicio)
            readfile("contenidos/" . $secciones[0]["archivo"]);
        }

        //Link to repository: https://github.com/andresito87/DWES/tree/main/dwes01/ejercicio2
        ?>
    </main>
    <footer>
        <p>Fecha del documento:
            <?php
            require "footer.php";
            ?>
        </p>
    </footer>
</body>

</html>