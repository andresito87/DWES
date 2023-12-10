<?php
/**
 * Cargar un archivo csv en un array bidimensional.
 * 
 * La función recibe un archivo csv y lo carga en un array bidimensional.
 * 
 * @param string $archivo Nombre del archivo csv a cargar.
 * @return array[] Array bidimensional con los datos del archivo csv o false si no se pudo cargar.
 */
function cargar_archivo(string $archivo): array|bool
{
    $fila = 0;
    $array = [];
    if (file_exists($archivo) && $archivo = fopen($archivo, "r")) {
        while ($datos = fgetcsv($archivo, 1000, ",")) {
            $array[] = $datos;
            $array[$fila][4] = explode("-", $array[$fila][4]);
            $array[$fila][5] = explode("-", $array[$fila][5]);
            $fila++;
        }
        fclose($archivo);
        // quitamos la cabedera del archivo csv
        array_shift($array);
    }
    return empty($array) ? false : $array;
}
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

/**
 * Mostrar los datos de un array bidimensional.
 *
 * La función recibe un array y lo muestra por pantalla.
 * 
 * @param array[] $datos Array de datos a mostrar.
 *
 * @return void Muestra por pantalla los datos del array.
 */
function mostrar_array(array $datos): void
{
    foreach ($datos as $alumno) {
        echo "<p>";
        foreach ($alumno as $key2 => $matriculacion) {
            // si es un array, lo recorremos
            if (($key2 === 4 || $key2 === 5)) {
                foreach ($matriculacion as $asignaturaORama) {
                    // si no es el ultimo elemento del array, le ponemos divisores
                    if ($key2 === 4 && end($matriculacion) !== $asignaturaORama) {
                        echo $asignaturaORama . " - ";
                        // si es el ultimo elemento del array, no le ponemos divisores
                    } else if ($key2 === 5 && end($matriculacion) !== $asignaturaORama) {
                        echo $asignaturaORama . " _ ";
                    } else {
                        echo $asignaturaORama;
                    }
                }
                // si no es un array, lo mostramos
            } else {
                echo $matriculacion;
            }
            // si no es el ultimo elemento del array, le ponemos divisores
            if (!is_array($matriculacion) && $key2 !== end($alumno)) {
                echo " | ";
            } else if (!empty($asignaturaORama) && $matriculacion !== end($alumno)) {
                echo "      ";
            }
        }
        echo "</p>";
    }
}

/**
 * Obtener un resumen de las asignaturas solicitadas.
 * 
 * La función recibe un array bidimensional y devuelve un array con los datos
 * resumidos según las asignaturas solicitadas.
 
 * @param array[] $datos Código del producto a insertar.
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
            if ($value2 === "LCL") {
                $resumen[0]['LCL']++;
            } elseif ($value2 === "M") {
                $resumen[0]['M']++;
            } elseif ($value2 === "BG") {
                $resumen[0]['BG']++;
            } elseif ($value2 === "GH") {
                $resumen[0]['GH']++;
            } elseif ($value2 === "FQ") {
                $resumen[0]['FQ']++;
            } elseif ($value2 === "I") {
                $resumen[0]['I']++;
            }
        }
    }
    return $resumen;
}

function mostrar_contabilizacion(array $datos): void
{
    foreach ($datos as $key => $value) {
        echo "<ul>";
        foreach ($value as $key2 => $value2) {
            echo "<li>$key2: $value2</li>";
        }
        echo "</ul>";
    }
}