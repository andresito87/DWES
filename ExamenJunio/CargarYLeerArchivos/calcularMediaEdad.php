<?php
// Nombre del archivo CSV
$csvFile = 'usuarios.csv';

// Array para almacenar las edades de los usuarios
$edades = [];

// Comprueba si el archivo CSV existe
if (file_exists($csvFile)) {
    // Abre el archivo CSV en modo lectura
    if (($handle = fopen($csvFile, 'r')) !== false) {
        // Lee la primera línea del archivo CSV para obtener los encabezados
        $encabezados = fgetcsv($handle, 1000, ',');

        // Busca la columna que contiene las edades y guarda su índice
        $columnaEdad = array_search('edad', $encabezados);

        // Lee cada línea del archivo CSV
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            // Obtiene la edad del usuario (según la columna detectada)
            $edad = (int) $data[$columnaEdad];
            // Agrega la edad al array de edades
            $edades[] = $edad;
        }

        // Cierra el archivo CSV
        fclose($handle);
    } else {
        echo "No se pudo abrir el archivo CSV.";
    }
} else {
    echo "El archivo CSV no existe.";
}

// Calcula la media de edad
$mediaEdad = 0;
if (! empty($edades)) {
    $sumaEdades = array_sum($edades);
    $cantidadUsuarios = count($edades);
    // Calcula la media de edad y la redondea a dos decimales
    $mediaEdad = round($sumaEdades / $cantidadUsuarios, 2);
}

echo 'La media de edad de los usuarios es: ' . $mediaEdad . ' años';
?>