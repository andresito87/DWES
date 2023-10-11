<?php
function cargar_archivo(string $archivo): array|bool
{
    $fila = 0;
    $array = [];
    if ($archivo = fopen($archivo, "r")) {
        while ($datos = fgetcsv($archivo, 1000, ",")) {
            $array[] = $datos;
            $array[$fila][4] = explode("-", $array[$fila][4]);
            $array[$fila][5] = explode("-", $array[$fila][5]);
            $fila++;
        }
        fclose($archivo);
        // quitamos la cabedera del archivo csv
        array_shift($array);
        return $array;
    } else {
        echo "No se pudo abrir el archivo";
        return false;
    }

}