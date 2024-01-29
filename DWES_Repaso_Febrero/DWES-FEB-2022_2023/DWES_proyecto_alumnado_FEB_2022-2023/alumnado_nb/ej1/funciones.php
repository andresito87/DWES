<?php
require_once('./vars.php');
/**
 * Función que, a partir de la lista de participantes, ubicada en la variable de ámbito global 
 * $participantes, genera un array de $n candidatos finalistas de manera aleatoria
 * 
 * @param $n: Número de candidatos que serán seleccionados
 * 
 * @return: Array con los $n candidatos seleccionados
 */

//IMPORTANTE: Crear aquí una función llamada getCandidatos que cumpla con la descripción anterior.

function getCandidatos($n)
{
  global $participantes;
  $candidatos = array();
  $candidatos = array_rand($participantes, $n);
  return $candidatos;
}

/**
 * Función que, a partir de la lista de candidatos seleccionados, ubicada en la variable pasada como parámetro $candidatos, genera una cadena HTML con el formulario para poder elegir el ganador final
 * 
 * @param $candidatos: Un array con los seleccionados a ganador.
 * 
 * @return: Cadena con el formulario que se imprimirá en el html con los candidatos seleccionados.
 */
function getFormularioCandidatosMarkup($candidatos)
{
  //Debes modificar esta función para que el formulario se construya dinámicament con los datos de $candidatos
  global $participantes;
  $output = '<form action="ganador.php" method="post">';
  foreach ($candidatos as $candidato) {
    $output .= '<div class="candidatoContainer">';
    $output .= '<h2>' . $participantes[$candidato]['nombre'] . '</h2>';
    $output .= '<img src="' . $participantes[$candidato]['imagen_url'] . '"><br>';
    $output .= '<input type="submit" value="Seleccionar" name="seleccionar[' . $candidato . ']">';
    $output .= '</div>';
  }
  $output .= '</form>';
  return $output;
}