<?php
/*Estadísticas de dominios (para practicar: sesiones)
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
$texto = "Si te gusta <A href='https://www.google.es/'>google</A>, no dudes en visitar doodle.com";
preg_match_all(PATRON[0], $texto, $matches);

var_dump($matches);

if (isset($_POST['enviar']) && $_POST['enviar'] == 'Enviar') {
    if (!isset($_SESSION['dominios'])) {
        $_SESSION['dominios'] = [];
    }
    foreach ($matches[1] as $dominio) {
        $dominio = explode('.', $dominio);
        $dominio = end($dominio);
        if (!isset($_SESSION['dominios'][$dominio])) {
            $_SESSION['dominios'][$dominio] = 1;
        } else {
            $_SESSION['dominios'][$dominio]++;
        }
    }
    foreach ($_SESSION['dominios'] as $dominio => $apariciones) {
        echo "El dominio $dominio aparece $apariciones veces<br>";
    }
} else if (isset($_POST['reiniciar']) && $_POST['reiniciar'] == 'Reiniciar') {
    unset($_SESSION);
} else {
    echo "No se ha enviado nada";
}

?>

<form action="" method="post">
    <input type="submit" name="enviar" value="Enviar">
    <input type="submit" name="reiniciar" value="Reiniciar">
</form>


