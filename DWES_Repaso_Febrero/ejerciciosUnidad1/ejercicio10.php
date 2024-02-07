<!-- 10. Genera un script PHP que lea datos de un archivo CSV y los muestre en una tabla HTML -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 10</title>
</head>
<body>
<?php
$archivo = fopen("datos.csv", "r");
echo "<table border='1'>";
while (($datos = fgetcsv($archivo)) !== false) {
    echo "<tr>";
    foreach ($datos as $dato) {
        echo "<td>$dato</td>";
    }
    echo "</tr>";
}
echo "</table>";
fclose($archivo);
?>
</body>
