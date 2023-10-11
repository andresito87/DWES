<?php
// Si el usuario no ha pulsado el botón de "Terminar" del formulario anterior,
// redirigirlo a index.php
if (!isset($_POST["Terminar"])) {
    header("Location: index.php");
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
    $error = false;
    if (!isset($_POST["codigo_postal"]) || empty($_POST["codigo_postal"]) || !preg_match("/^\d{5}$/", $_POST["codigo_postal"])) {
        echo "El código postal no es válido <BR>";
        $error = true;
    }
    if (!isset($_POST["sexo"]) || ($_POST["sexo"] != "M" && $_POST["sexo"] != "F" && $_POST["sexo"] != "O" && $_POST["sexo"] != "N")) {
        echo "El sexo no es válido <BR>";
        $error = true;
    }
    if (!isset($_POST["curso"]) || $_POST["curso"] != "1ESO" && $_POST["curso"] != "2ESO" && $_POST["curso"] != "3ESO") {
        echo "El curso no es válido <BR>";
        $error = true;
    }
    if (!isset($_POST["rama"]) || $_POST["rama"] != "BCH" && $_POST["rama"] != "FP") {
        echo "La rama no es válida";
        $error = true;
    }
    if (isset($_POST["asgs"])) {
        if (count($_POST["asgs"]) <= 7) {
            foreach ($_POST["asgs"] as $asg) {
                if ($asg == "BG" && $_POST["curso"] == "2ESO") {
                    echo "Asignatura Biología y Geología no matriculable en 2º ESO";
                    $error = true;
                    break;
                } else if ($asg != "LCL" && $asg != "M" && $asg != "BG" && $asg != "GH" && $asg != "FQ" && $asg != "I") {
                    echo "Asignatura inválida encontrada, revise el formulario <BR>";
                    $error = true;
                    break;
                }
            }
        } else {
            echo "Has seleccionado demasiadas asignaturas <BR>";
            $error = true;
        }
    }
    if (isset($_POST['tiempolibre'])) {
        if (count($_POST['tiempolibre']) <= 8) {
            foreach ($_POST['tiempolibre'] as $tiempo) {
                if ($tiempo != "deportes" && $tiempo != "musica" && $tiempo != "danza" && $tiempo != "art" && $tiempo != "vjuegos" && $tiempo != "television" && $tiempo != "dom" && $tiempo != "lectura") {
                    echo "Opción de tiempo libre inválida <BR>";
                    $error = true;
                    break;
                }
            }
        } else {
            echo "Has seleccionado demasiadas opciones de tiempo libre <BR>";
            $error = true;
        }
    }
    // Si no hay errores, mostramos el resumen de los datos introducidos
    if (!$error) {
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
        <h3>Los datos no se han guardado</h3>
        <form action="index.php" method="post">
            <input type="submit" name="Volver" value="Volver">
        </form>
        <?php
    }
    ?>
</body>

</html>