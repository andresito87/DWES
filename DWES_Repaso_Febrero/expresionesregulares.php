
<?php
$cadena = "[nombre y apellidos 3] 123123123;(nombre y apellidos 4) 123123124;(nombre y apellidos 5) 123123125;[nombre y apellidos 6] 123123126;";

// Definir el patrón de división
$patron = '/[,\t\s\-\];/';

// Dividir la cadena en un array usando el patrón
$arrayUsuarios = preg_split($patron, $cadena, -1, PREG_SPLIT_NO_EMPTY);

// Imprimir resultados
print_r($arrayUsuarios);
?>