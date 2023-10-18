<?php
/**
 * Obtener un resumen de las asignaturas solicitadas.
 * 
 * La función recibe un array bidimensional y devuelve un array con los datos
 * resumidos según las asignaturas solicitadas.
 *
 *
 * 
 * @param array[] $datos Código del producto a insertar.
 * 
 * @return array[] Array con los datos resumidos.
 */
function obtener_resumen_asg(array $datos): array
{
    //mostrar el array de asignaturas
    $asignaturas = array();
    foreach ($datos as $key => $value) {
        $asignaturas[] = $value[4];
    }
    //mostrar el array de asignaturas
    $resumen = array();
    $resumen[] = array('LCL' => 0, 'M' => 0, 'BG' => 0, 'GH' => 0, 'FQ' => 0, 'I' => 0);
    foreach ($asignaturas as $key => $value) {
        foreach ($value as $key2 => $value2) {
            //suma 1 a la asignatura correspondiente
            if ($value2 == "LCL") {
                $resumen[0]['LCL']++;
            } elseif ($value2 == "M") {
                $resumen[0]['M']++;
            } elseif ($value2 == "BG") {
                $resumen[0]['BG']++;
            } elseif ($value2 == "GH") {
                $resumen[0]['GH']++;
            } elseif ($value2 == "FQ") {
                $resumen[0]['FQ']++;
            } elseif ($value2 == "I") {
                $resumen[0]['I']++;
            }
        }
    }
    return $resumen;
}