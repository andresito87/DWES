<?php
/**
 * Filtrar los datos de un array bidimensional por curso.
 * 
 * La función recibe un array bidimensional y un curso y devuelve un array con los datos
 * filtrados.
 *
 * 
 * @param string $curso Código del curso a filtrar.
 * @param array[] $datos Código del producto a insertar.
 * 
 * @return array[] Array con los datos filtrados.
 */
function filtrar_por_curso(string $curso, array $datos): array
{
    $array = array();
    foreach ($datos as $key => $value) {
        if ($value[2] == $curso) {
            $array[] = $value;
        }
    }
    return $array;
}