<?php
function filtrar_por_curso($curso, $datos)
{
    $array = array();
    foreach ($datos as $key => $value) {
        if ($value[2] == $curso) {
            $array[] = $value;
        }
    }
    return $array;
}