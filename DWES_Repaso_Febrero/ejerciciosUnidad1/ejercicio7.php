<?php
/*7. Escribe un script que incluya un archivo PHP usando `require_once` y maneje errores si el archivo
no se encuentra.*/

try {
    require_once("archivo.php");
    echo "<br>El archivo se ha incluido correctamente";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>


