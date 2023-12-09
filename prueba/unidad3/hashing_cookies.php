<?php

if (!isset($_COOKIE['datos']) || !isset($_COOKIE['verificacion'])) {
    $mensaje = "No había cookies, por lo que se envían por primera vez";
    $datos = ['a' => 1, 'b' => 2];
    setcookie('datos', serialize($datos), time() + 600);
    setcookie('verificacion', hash('sha256', serialize($datos)), time() + 600);
} else {
    if (hash('sha256', $_COOKIE['datos']) === $_COOKIE['verificacion']) {
        $mensaje = "cookie verificada";
        $datos = unserialize($_COOKIE['datos']);
    } else {
        $mensaje = "La verificación fallo, por lo que se borran las cookies";
        $datos = [];
        setcookie('datos', '', time() - 600);
        setcookie('verificacion', '', time() - 600);
    }
}

echo $mensaje;