<?php
// Si el usuario no ha pulsado el botón de "Terminar" del formulario anterior,
// redirigirlo a index.php
if (!isset($_POST["Terminar"])) {
    header("Location: index.php");
}

$errores = [];
$datos_validos = [
    "codigo_postal" => "/^\d{5}$/",
    "sexo" => ["M", "F", "O", "N"],
    "curso" => ["1ESO", "2ESO", "3ESO"],
    "rama" => ["BCH", "FP"],
    "asgs" => ["LCL", "M", "BG", "GH", "FQ", "I"],
    "tiempolibre" => ["deportes", "musica", "danza", "art", "vjuegos", "television", "dom", "lectura"]
];

if (!isset($_POST["codigo_postal"]) || !preg_match($datos_validos["codigo_postal"], $_POST["codigo_postal"])) {
    $errores[] = "El código postal no es válido";
}
if (!isset($_POST["sexo"]) || !in_array($_POST["sexo"], $datos_validos["sexo"])) {
    $errores[] = "El sexo no es válido";
}
if (!isset($_POST["curso"]) || !in_array($_POST["curso"], $datos_validos["curso"])) {
    $errores[] = "El curso no es válido";
}
if (!isset($_POST["rama"]) || !in_array($_POST["rama"], $datos_validos["rama"])) {
    $errores[] = "La rama no es válida";
}
//Comprobamos que las asignaturas existen y forman un array
if (isset($_POST["asgs"]) && is_array($_POST["asgs"]) && count($_POST["asgs"]) > 0) {
    if (count($_POST["asgs"]) <= 7) {
        foreach ($_POST["asgs"] as $asg) {
            if ($asg === "BG" && $_POST["curso"] === "2ESO") {
                $errores[] = "Asignatura Biología y Geología no matriculable en 2º ESO";
                break;
            }

            if (!in_array($asg, $datos_validos["asgs"])) {
                $errores[] = "Asignatura inválida encontrada, revise el formulario";
                break;
            }
        }
    } else {
        $errores[] = "Has seleccionado demasiadas asignaturas";
    }
}
//Comprobamos que los tiempos libres existen y forman un array
if (isset($_POST['tiempolibre']) && is_array($_POST['tiempolibre'])) {
    if (count($_POST['tiempolibre']) <= 8) {
        foreach ($_POST['tiempolibre'] as $opcion_tiempo_libre) {
            if (!in_array($opcion_tiempo_libre, $datos_validos['tiempolibre'])) {
                $errores[] = "Opción de tiempo libre inválida encontrada";
                break;
            }
        }
    } else {
        $errores[] = "Has seleccionado demasiadas opciones de tiempo libre";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respira - Resumen del Formulario</title>
</head>

<body>
    <h1>Resumen del proceso</h1>
    <?php
    // Si no hay errores, mostramos el resumen de los datos introducidos
    if (!$errores) {
        echo "<h2>Resumen: </h2>";
        echo "Código postal: " . $_POST["codigo_postal"] . "<BR>";
        echo "Sexo: " . $_POST["sexo"] . "<BR>";
        echo "Curso: " . $_POST["curso"] . "<BR>";
        echo "Rama: " . $_POST["rama"] . "<BR>";
        echo "Asignaturas: ";
        if (array_key_exists("asgs", $_POST) && count($_POST["asgs"]) > 0) {
            foreach ($_POST["asgs"] as $asg) {
                echo $asg . " ";
            }
        } else {
            echo "Ninguna";
        }
        echo "<BR>";
        echo "Tiempo libre: ";
        if (array_key_exists("tiempolibre", $_POST) && count($_POST["tiempolibre"]) > 0) {
            foreach ($_POST["tiempolibre"] as $tiempo) {
                echo $tiempo . " ";
            }
        } else {
            echo "Ninguna";
        }
        echo "<BR><h2>Información almacenada correctamente<h2>";
        echo "<h3>¡¡¡Gracias!!!</h3>";
        // Si no hay errores, guardamos los datos en el archivo CSV
        // Preparamos los datos a almacenar
        $datos = [
            $_POST["codigo_postal"],
            $_POST["sexo"],
            $_POST["curso"],
            $_POST["rama"],
            array_key_exists("asgs", $_POST) ? implode("-", $_POST["asgs"]) : "",
            array_key_exists("tiempolibre", $_POST) ? implode("-", $_POST["tiempolibre"]) : ""
        ];
        // Incluimos la función para guardar los datos en el archivo CSV
        include "guardar_datos_en_csv.php";
        guardar_datos_en_csv($datos);
    }
    // Si hay errores, mostramos un botón para volver al formulario
    else {
        ?>
        <h2>Por favor, revise los errores y vuelva a intentarlo</h2>
        <ul>
            <?php
            foreach ($errores as $error) {
                echo "<li>$error</li>";
            }
            ?>
            <h3>Los datos no se han guardado</h3>
            <form action="index.php" method="post">
                <input type="submit" name="Volver" value="Volver">
            </form>
            <?php
    }
    ?>
</body>

</html>