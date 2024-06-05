<?php
// Iniciar la sesión
session_start();

// Verificar si existe la frecuencia de palabras en la sesión y sino se crea
if (! isset($_SESSION['frecuencia_palabras'])) {
    $_SESSION['frecuencia_palabras'] = [];
}

// Archivo de texto
$archivo = 'palabras.txt';

// Verificar si el archivo existe
if (file_exists($archivo)) {
    // Leer el contenido del archivo
    $contenido = file_get_contents($archivo);

    // Convertir el contenido a minúsculas y dividirlo en palabras
    $palabras = str_word_count(strtolower($contenido), 1);

    // Contar la frecuencia de cada palabra
    $frecuencia_palabras = array_count_values($palabras);

    // Recorrer el array de frecuencia de palabras y sumar las frecuencias de cada palabra
    foreach ($frecuencia_palabras as $palabra => $frecuencia) {
        if (isset($_SESSION['frecuencia_palabras'][$palabra])) {
            $_SESSION['frecuencia_palabras'][$palabra] += $frecuencia;
        } else {
            $_SESSION['frecuencia_palabras'][$palabra] = $frecuencia;
        }
    }

    echo "Se ha contado la frecuencia de las palabras y se ha almacenado en la sesión.";

    // Mostrar enlace para ver la frecuencia de palabras
    echo "<br><a href='mostrarPalabras.php'>Ver frecuencia de palabras</a>";
} else {
    echo "El archivo '$archivo' no existe.";
}
?>