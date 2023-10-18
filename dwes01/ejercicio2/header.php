<?php
    global $secciones;
    foreach ($secciones as $seccion) {
    $query_string = "?ver=" . urlencode($seccion["link"]);
    if (!isset($_GET["ver"])) {
        if ($seccion["nombre"] === SECCION_DEFECTO) {
            echo "<strong>{$seccion["nombre"]}</strong>";
        } else {
            echo "<a href='$query_string'>{$seccion["nombre"]}</a>";
        }
    } else if ($_GET["ver"] === $seccion["link"]) {
        echo "<strong>{$seccion["nombre"]}</strong>";
    } else {
        echo "<a href='$query_string'>{$seccion["nombre"]}</a>";
    }
    if ($seccion !== end($secciones)) {
        echo " | ";
    }
}
