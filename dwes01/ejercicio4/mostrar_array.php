<?php
    /**
     * Mostrar los datos de un array bidimensional.
     *
     * La función recibe un array y lo muestra por pantalla.
     *
     *
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
                //TODO: La separacion entre asignaturas y rama no es la correcta
            }
            echo "</p>";
        }
    }