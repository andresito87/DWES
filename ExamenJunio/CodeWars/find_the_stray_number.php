<?php

/*You are given an odd-length array of integers, in which all of them are the same, except for one single number.

Complete the method which accepts such an array, and returns that single different number.

The input array will always be valid! (odd-length >= 3)

Examples
[1, 1, 2] ==> 2
[17, 17, 3, 17, 17, 17, 17] ==> 3*/

function stray($arr)
{
    // Contar la frecuencia de cada número en el array
    $counts = array_count_values($arr);

    // Buscar el número que aparece exactamente una vez
    $unique = array_search(1, $counts);

    return $unique;

}

echo stray([1, 1, 2]);
echo stray([17, 17, 3, 17, 17, 17, 17]);