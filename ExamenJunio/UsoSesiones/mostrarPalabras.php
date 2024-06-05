<?php
// Iniciar la sesión
session_start();



// Verificar si existe la frecuencia de palabras en la sesión
if (isset($_SESSION['frecuencia_palabras'])) {
    // Recuperar la frecuencia de palabras de la sesión
    $frecuencia_palabras = $_SESSION['frecuencia_palabras'];

    // Mostrar la frecuencia de cada palabra
    echo "<h2>Frecuencia de palabras:</h2>";
    foreach ($frecuencia_palabras as $palabra => $frecuencia) {
        echo "$palabra: $frecuencia<br>";
    }
} else {
    echo "No se ha contado la frecuencia de palabras. Por favor, ejecuta 'contador_palabras.php' primero.";
}

// Mostrar boton que borra la frecuencia de palabras
echo "<br><br><a href='borrarDatosSesion.php'>Borrar frecuencia de palabras</a>";
?>