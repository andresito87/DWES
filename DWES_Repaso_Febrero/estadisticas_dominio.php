<?php
/* https://www.phpliveregex.com/ Expresiones regulares
Estadísticas de dominios (para practicar: sesiones)
Implementaremos un script que extraiga enlaces o URLs en un texto proporcionado que presumiblemente es HTML. Por ejemplo:

Si te gusta <A href="https://www.google.es/">google</A>, no dudes en visitar doodle.com

En el texto anterior debería extraer "www.google.es" y "doodle.com". Una vez extraídos simplemente debes quedarte con la parte del dominio de primer nivel (.com, .es, etc.).

Para extraer los dominios debes usar la siguiente expresión regular con la función preg_match_all:

define('PATRON',['/\b([a-zA-Z0-9-]+(?:\.[a-zA-Z]{2,})+)\b/']);
preg_match_all(... patron..., $texto, $matches);

Nuestro script irá acumulando gracias al uso de sesiones las veces que aparece cada dominio de primer nivel, elaborando así una estadística del mismo (porcentaje de aparición de cada uno).

El script debe permitir "reiniciar" el proceso.
*/

define('PATRON', ['/\b([a-zA-Z0-9-]+(?:\.[a-zA-Z]{2,})+)\b/']);
session_start();
if (!isset($_SESSION['estadísticas'])) {
    $_SESSION['estadísticas'] = [];
}

$texto = filter_input(INPUT_POST, 'texto');
if (!is_null($texto) && !empty($texto)) {
    if (preg_match_all(PATRON[0], $texto, $matches)) {
        foreach ($matches[1] as $dominio) {
            $array = explode('.', $dominio);
            //$array = preg_split('/\./', $dominio);
            $extension = array_pop($array);
            //$extension = end($array);
            if (!isset($_SESSION['estadísticas'][$extension])) {
                $_SESSION['estadísticas'][$extension] = 1;
            } else {
                $_SESSION['estadísticas'][$extension]++;
            }
        }
    } else
        echo "No has introducido ningún dominio válido<br>";
} else if (isset($_POST['borrar']) && $_POST['borrar'] == 'Borrar datos de sesion') {
    unset($_SESSION['estadísticas']);
    echo "Las estadídisticas almacenadas en la sesión han sido eliminadas.<br>";
} else {
    echo "No se ha enviado nada.<br>";
}

if (isset($_SESSION['estadísticas']) && !empty($_SESSION['estadísticas'])) {
    echo "ESTADÍSTICAS:<br>";
    foreach ($_SESSION['estadísticas'] as $extension => $apariciones) {
        echo "El dominio $extension aparece $apariciones veces.<br>";
    }
}

?>

<form action="" method="post">
    <textarea name="texto" id="" cols="30" rows="10"></textarea>
    <input type="submit" name="enviar" value="Enviar">
    <input type="submit" name="borrar" value="Borrar datos de sesion">
</form>