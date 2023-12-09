<?php
// Iniciamos la sesión o recuperamos la anterior sesión existente
session_start();
// Comprobamos si la variable ya existe
if (isset($_SESSION['numero_visitas']))
    $_SESSION['numero_visitas']++;
else
    $_SESSION['numero_visitas'] = 0;

// En cada visita añadimos un valor al array "visitas"
if (!isset($_SESSION['hora_visitas']))
    $_SESSION['hora_visitas'] = [time()];
else
    $_SESSION['hora_visitas'][] = time();

echo "El número de sesiones iniciadas en el servidor son {$_SESSION['numero_visitas']}";
echo "<br>";
var_dump($_SESSION['hora_visitas']);
echo "<br>";
?>