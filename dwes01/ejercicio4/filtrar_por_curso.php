<?php
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