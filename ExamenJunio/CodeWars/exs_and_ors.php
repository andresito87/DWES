<?php
/*Check to see if a string has the same amount of 'x's and 'o's. The method must return a boolean and be case insensitive. The string can contain any char.

Examples input/output:

XO("ooxx") => true
XO("xooxx") => false
XO("ooxXm") => true
XO("zpzpzpp") => true // when no 'x' and 'o' is present should return true
XO("zzoo") => false*/

function XO($s)
{
    $stringLowerCase = strtolower($s);
    $arrayLetras = str_split($stringLowerCase);
    $cantidadO = 0;
    $cantidadX = 0;

    foreach ($arrayLetras as $letra) {
        if ($letra == "x") {
            $cantidadX++;
        } else if ($letra == "o") {
            $cantidadO++;
        }
    }

    return $cantidadX == $cantidadO;
}
echo (XO("ooxx") ? "true" : "false") . " => true" . PHP_EOL;
echo (XO("xooxx") ? "true" : "false") . " => false" . PHP_EOL;
echo (XO("ooxXm") ? "true" : "false") . " => true" . PHP_EOL;
echo (XO("zpzpzpp") ? "true" : "false") . " => true" . PHP_EOL;
echo (XO("zzoo") ? "true" : "false") . " => false" . PHP_EOL;

/* Most Voted Solution*/
function XO_comunity($s)
{
    return substr_count(strtolower($s), 'x') === substr_count(strtolower($s), 'o');
}

echo (XO_comunity("ooxx") ? "true" : "false") . " => true" . PHP_EOL;
echo (XO_comunity("xooxx") ? "true" : "false") . " => false" . PHP_EOL;
echo (XO_comunity("ooxXm") ? "true" : "false") . " => true" . PHP_EOL;
echo (XO_comunity("zpzpzpp") ? "true" : "false") . " => true" . PHP_EOL;
echo (XO_comunity("zzoo") ? "true" : "false") . " => false" . PHP_EOL;