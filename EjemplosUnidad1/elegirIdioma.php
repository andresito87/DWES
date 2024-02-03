<?php
include 'calcularFechaEnCastellano.php';
include 'calcularFechaEnIngles.php';

function calcularFechaEn()
{
    $idioma = $_POST['respuesta'];
    print $idioma;
    $mensajeIdiomaElegido = "Idioma elegido " . $idioma . "! <br>";
    echo $mensajeIdiomaElegido . "<br>";

    if ($idioma == "espanol") {
        $mensaje = calcularFechaEnCastellano();
    } else if ($idioma == "ingles") {
        $mensaje = calcularFechaEnIngles();
    } else {
        $mensaje = "Idioma no soportado";
    }
    return $mensaje;

}