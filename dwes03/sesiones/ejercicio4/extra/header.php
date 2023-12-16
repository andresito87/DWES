<?php
if (!isset($_SESSION)) {
    session_start();
}
$nombre_apellidos = $_SESSION['dni'][2] . " " . $_SESSION['dni'][3];
$rol = $_SESSION['dni'][4];
$mostrar_link_detalle_ultimo_usuario = false;
if (isset($_SESSION['ultimo_detalle_usuario']) && (verificacion_rol($_SESSION['dni'], 'admin') || verificacion_rol($_SESSION['dni'], 'coord') || verificacion_rol($_SESSION['dni'], 'trasoc'))) {
    $mostrar_link_detalle_ultimo_usuario = true;
}

?>

<header>
    <div id='header'>
        <?php
        echo $nombre_apellidos . " [ROLES: " . $rol . "]";
        if ($mostrar_link_detalle_ultimo_usuario) {
            echo " | ";
            echo "<a href='./detalleusuario.php'> Ver detalles último usuario consultado</a>";
        }
        echo " | ";
        echo " <a href='./logout.php'>Salir</a>";
        ?>
    </div>
</header>