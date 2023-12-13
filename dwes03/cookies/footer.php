<?php
echo "<p>Fecha y hora del documento: ";
//Muestra la fecha de modificación del archivo en formato dd/mm/aaaa
echo "<span>" . date("d/m/Y H:m", filemtime("footer.php")) . "</span></p>";


if (!isset($_COOKIE["lista_ultimos_sitios"]) || !isset($_COOKIE["hash_lista_ultimos_sitios"])) {
    //Si no existe la cookie, se crea
    if (isset($_GET["ver"]) && in_array($_GET["ver"], array_column($secciones, "link"))) {
        $seccion_visitada = $secciones[array_search($_GET["ver"], array_column($secciones, "link"))]["nombre"];
        $link_seccion_visitada = "./index.php?ver=" . urlencode($_GET["ver"]);
        $fecha_hora_visita = date("d/m/Y H:m");
        $datos_visita[] = [$seccion_visitada, $link_seccion_visitada, $fecha_hora_visita];
        setcookie('lista_ultimos_sitios', serialize($datos_visita), time() + 600);
        setcookie('hash_lista_ultimos_sitios', hash('sha256', serialize($datos_visita)), time() + 600);
    }
} else {
    //Si existe la cookie, se añade el nuevo sitio
    if (hash('sha256', $_COOKIE['lista_ultimos_sitios']) === $_COOKIE['hash_lista_ultimos_sitios']) {
        //Si coincide el hash, se añade el nuevo sitio
        $seccion_visitada = $secciones[array_search($_GET["ver"], array_column($secciones, "link"))]["nombre"];
        $link_seccion_visitada = "./index.php?ver=" . urlencode($_GET["ver"]);
        $fecha_hora_visita = date("d/m/Y h:m");
        $datos_visita[] = [$seccion_visitada, $link_seccion_visitada, $fecha_hora_visita];
        $lista_ultimos_sitios = @unserialize($_COOKIE['lista_ultimos_sitios']);
        if (!in_array($seccion_visitada, array_column($lista_ultimos_sitios, 0)) && count($lista_ultimos_sitios) < MAX_SECCIONES) {
            //Si la sección no existe, se añade al principio
            $lista_ultimos_sitios = array_merge($datos_visita, $lista_ultimos_sitios);
        } else if (in_array($seccion_visitada, array_column($lista_ultimos_sitios, 0))) {
            //Si la sección ya existe, se elimina y se añade al principio
            unset($lista_ultimos_sitios[array_search($seccion_visitada, array_column($lista_ultimos_sitios, 0))]);
            $lista_ultimos_sitios = array_values($lista_ultimos_sitios);
            $lista_ultimos_sitios = array_merge($datos_visita, $lista_ultimos_sitios);
        } else {
            //Si la lista está llena, se elimina el último elemento y se añade al principio
            $lista_ultimos_sitios = array_merge($datos_visita, array_slice($lista_ultimos_sitios, 0, MAX_SECCIONES - 1));
        }
        setcookie('lista_ultimos_sitios', serialize($lista_ultimos_sitios), time() + 600);
        setcookie('hash_lista_ultimos_sitios', hash('sha256', serialize($lista_ultimos_sitios)), time() + 600);
    } else {
        //Si no coincide el hash, se resetea la cookie con la sección actual
        $seccion_visitada = $_GET["ver"];
        $link_seccion_visitada = "./index.php?ver=" . urlencode($_GET["ver"]);
        $fecha_hora_visita = date("d/m/Y h:m");
        $datos_visita[] = [$seccion_visitada, $link_seccion_visitada, $fecha_hora_visita];
        setcookie('lista_ultimos_sitios', serialize($datos_visita), time() + 600);
        setcookie('hash_lista_ultimos_sitios', hash('sha256', serialize($datos_visita)), time() + 600);
    }
    echo "<p>Últimas páginas visitadas:</p>";
    echo "<div id=\"secciones_visitadas\">";
    foreach ($lista_ultimos_sitios as $sitio) {
        echo "<a href='" . $sitio[1] . "'>" . $sitio[0] . " (" . $sitio[2] . ") </a><br>";
    }
    echo "</div>";
}
?>