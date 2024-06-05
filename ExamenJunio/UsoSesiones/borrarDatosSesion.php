<?php

// Iniciar la sesión
session_start();

// Borrar la frecuencia de palabras de la sesión
unset($_SESSION['frecuencia_palabras']);

echo "Se ha borrado la frecuencia de palabras de la sesión.";
echo "<br><a href='contadorPalabras.php'>Volver a contar la frecuencia de palabras</a>";
?>