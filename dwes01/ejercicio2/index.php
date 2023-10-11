<!DOCTYPE html>
<html lang="en">

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
                if ($seccion["link"] == $_GET["ver"]) {
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
        <!-- Se incluye el logo-->
        <img src="./assets/logo.avif" alt="Logo">
        <h1>Respira</h1>
        <nav>
            <?php
            require "header.php";
            ?>
        </nav>
    </header>
    <main>
        <!-- Se incluye el contenido de la sección seleccionada -->
        <?php
        if (isset($_GET["ver"])) {
            foreach ($secciones as $seccion) {
                if ($seccion["link"] == $_GET["ver"]) {
                    readfile("contenidos/" . $seccion["archivo"]);
                }
            }
        } else {
            // Si no se ha seleccionado ninguna sección, se muestra la primera(Inicio)
            readfile("contenidos/" . $secciones[0]["archivo"]);
        }
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