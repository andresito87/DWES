<?php
/*4. Diseña una página que utilice funciones para realizar diferentes operaciones matemáticas y muestre
los resultados*/
function suma($a, $b)
{
    return $a + $b;
}

function resta($a, $b)
{
    return $a - $b;
}

function multiplicacion($a, $b)
{
    return $a * $b;
}

function division($a, $b)
{
    return $a / $b;
}

function potencia($a, $b)
{
    return $a ** $b;
}

function raizCuadrada($a)
{
    return sqrt($a);
}

function raizCubica($a)
{
    return pow($a, 1 / 3);
}

function factorial($a)
{
    if ($a == 0) {
        return 1;
    } else {
        return $a * factorial($a - 1);
    }
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Funciones matemáticas</title>
</head>
<body>
<?php
echo suma(2, 3);
echo "<br>";
echo resta(2, 3);
echo "<br>";
echo multiplicacion(2, 3);
echo "<br>";
echo division(2, 3);
echo "<br>";
echo potencia(2, 3);
echo "<br>";
echo raizCuadrada(2);
echo "<br>";
echo raizCubica(2);
echo "<br>";
echo factorial(5);
echo "<br>";
?>
</body>
</html>


