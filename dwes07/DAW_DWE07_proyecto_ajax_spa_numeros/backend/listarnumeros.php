<?php

define('AUTH_REQUIRED', true);
require_once 'boot.php';

if ($metodoHTTP === 'GET') {
    echo json_encode(array_values($datos));
} else {
    echo json_encode(["error" => "Método no implementado en " . __FILE__]);
}