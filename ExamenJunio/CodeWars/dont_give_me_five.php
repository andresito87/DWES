<?php

/*
Don't give me five!
In this kata you get the start number and the end number of a region and should return the count of all numbers except numbers with a 5 in it. The start and the end number are both inclusive!

Examples:

1,9 -> 1,2,3,4,6,7,8,9 -> Result 8
4,17 -> 4,6,7,8,9,10,11,12,13,14,16,17 -> Result 12
*/

function dont_give_me_five($start, $end)
{
    $resultado = 0;
    $numeros = range($start, $end, 1);
    foreach ($numeros as $numero) {
        if (strpos((string) $numero, '5') === false) {
            $resultado++;
        }
    }
    return $resultado;
}

//echo dont_give_me_five(1, 9);
echo dont_give_me_five(4, 17);