<?php
function mostrar_array($array)
{
    foreach ($array as $key => $value) {
        echo "<p>";
        foreach ($value as $key2 => $value2) {
            // si es un array, lo recorremos
            if (($key2 == 4 || $key2 == 5)) {
                foreach ($value2 as $key3 => $value3) {
                    // si no es el ultimo elemento del array, le ponemos divisores
                    if ($value3 != "" && end($value2) != $value3) {
                        echo $value3 . "   ----   ";
                        // si es el ultimo elemento del array, no le ponemos divisores
                    } else {
                        echo $value3;
                    }
                }
                // si no es un array, lo mostramos
            } else {
                // si no es el ultimo elemento del array, le ponemos divisores
                if ($value2 != "" && end($value) != $value2) {
                    echo $value2 . "   ----   ";
                    // si es el ultimo elemento del array, no le ponemos divisores
                } else {
                    echo $value2;
                }
            }
        }
        echo "</p>";
    }
}
?>