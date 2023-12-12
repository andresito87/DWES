<?php
/**
 * Código que averigua si los elementos de la siguiente cadena de texto están ordenados 
 * en función de la letra en la primera posición y en función del número de la segunda posición.
 */

$datos = ['a2', 'x3', 'c5', 'd4'];

$letra = null;
$numero = null;
$ordenados_por_letra = true;
$ordenados_por_numero = true;
foreach ($datos as $key => $val) {
    if ($letra == null)
        $letra = ord($val[0]);
    elseif (ord($val[0]) >= $letra)
        $letra = ord($val[0]);
    else
        $ordenados_por_letra = false;

    if ($numero == null)
        $numero = intval($val[1]);
    elseif (intval($val[1]) >= $numero)
        $numero = intval($val[1]);
    else
        $ordenados_por_numero = false;

    if (!$ordenados_por_numero && !$ordenados_por_letra) //Cambio OR lógico por AND lógico
        break;
}

if ($ordenados_por_letra)
    echo "Los datos están SI ordenados por el primer símbolo alfanumérico";
else
    echo "Los datos están NO ordenados por el primer símbolo alfanumérico";

echo "<BR>" . PHP_EOL;

if ($ordenados_por_numero)
    echo "Los datos están SI ordenados por el segundo dígito numérico";
else
    echo "Los datos están NO ordenados por el segundo dígito numérico";