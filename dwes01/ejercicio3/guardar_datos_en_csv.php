<?php
// Función para guardar los datos en el archivo CSV
function guardar_datos_en_csv(array $datos): void
{
    // si el archivo no existe, lo creamos
    if (!file_exists("datos.csv")) {
        $cabecera = ["codigo_postal", "sexo", "curso", "rama", "asignaturas", "tiempo_libre"];
        $archivo_csv = fopen("datos.csv", "w");
        // guardamos la cabecera
        fputcsv($archivo_csv, $cabecera);
        fclose($archivo_csv);
    }
    $archivo_csv = fopen('datos.csv', 'a'); //abrimos el archivo en modo "añadir al final"
    fputcsv($archivo_csv, $datos); //Guardamos los datos al final
    fclose($archivo_csv); //Cerramos el archivo
}
