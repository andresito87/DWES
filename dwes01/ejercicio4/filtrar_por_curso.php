<?php
/**
 * Filtrar los datos de un array bidimensional por curso.
 * 
 * La función recibe un array bidimensional y un curso y devuelve un array con los datos
 * filtrados.
 *
 * 
 * @param string $curso Código del curso a filtrar.
 * @param array[] $datos Array bidimensional con los datos a filtrar.
 * 
 * @return array[] Array con los datos filtrados.
 */
function filtrar_por_curso(string $curso, array $datos): array
{
    $array = array();
    foreach ($datos as $alumno) {
        if ($alumno[2] === $curso) {
            $array[] = $alumno;
        }
    }
    return $array;
}