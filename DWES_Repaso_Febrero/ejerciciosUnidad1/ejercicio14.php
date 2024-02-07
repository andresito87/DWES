<?php
/*14. Desarrolla un script que convierta un array multidimensional en un array asociativo y viceversa*/

$array = array(
    "primero" => array('nombre' => "Andrés",
        'apellidos' => "Podadera Gonzalez",
        'edad' => 34),
    "segundo" => array('nombre' => "Ana",
        'apellidos' => "Podadera Gonzalez",
        'edad' => 32)
);

foreach ($array as $value) {
    $arrayIndexado[] = array($value['nombre'], $value['apellidos'], $value['edad']);
}

$arrayClavesPrimerNivel = array_keys($array); // Obtener las claves del array original
$arrayClavesSegundoNivel = array_keys($array[array_key_first($array)]);

// OTRA ALTERNATIVA: Acceder al primer subarray utilizando su índice
//$primerSubarray = reset($array); // reset() devuelve el primer elemento de un array
// Obtener las claves del segundo nivel del primer subarray
//$arrayClavesSegundoNivel = array_keys($primerSubarray);

// OTRA ALTERNATIVA: Iterar sobre el array principal para encontrar la primera clave
/*foreach ($array as $subarray) {
    // Verificar si el subarray no está vacío
    if (!empty($subarray)) {
        // Obtener las claves del subarray y romper el bucle
        $arrayClavesSegundoNivel = array_keys($subarray);
        break; // Romper el bucle después de encontrar las claves del segundo nivel
    }
}*/

$arrayAsociativo = array(); // Inicializar el array asociativo
//Version for tradicional
for ($i = 0; $i < count($arrayClavesPrimerNivel); $i++) {
    $clave = $arrayClavesPrimerNivel[$i];
    $arrayInterior = array($array[$clave]);
    for ($j = 0; $j < count($arrayClavesSegundoNivel); $j++) {
        $claveInterna = $arrayClavesSegundoNivel[$j];
        $arrayAsociativo[$clave][$claveInterna] = $arrayInterior[0][$claveInterna];
    }
}

//Version foreach
/*$i = 0; // Variable para mantener el índice del array indexado
foreach ($arrayClaves as $clave) {
    $arrayAsociativo[$clave] = array(
        "nombre" => $arrayIndexado[$i][0], // Acceder al nombre desde el array indexado
        "apellidos" => $arrayIndexado[$i][1], // Acceder a los apellidos desde el array indexado
        "edad" => $arrayIndexado[$i][2] // Acceder a la edad desde el array indexado
    );
    $i++; // Incrementar el índice del array indexado
}*/

echo "<strong>Array Principal</strong><br>";
var_dump($array);
echo "<br><strong>Array Indexado</strong><br>";
var_dump($arrayIndexado);
echo "<br><strong>Array Asociativo</strong><br>";
var_dump($arrayAsociativo);