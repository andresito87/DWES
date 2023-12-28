<?php
if (!isset($_SESSION)) {
    session_start();
}
$nombre_apellidos = $_SESSION['auth']['nombre'] . " " . $_SESSION['auth']['apellidos'];
$rol = $_SESSION['auth']['roles'];
$mostrar_link_detalle_ultimo_usuario = false;
if (isset($_SESSION['ultimo_detalle_usuario']) && (verificacion_rol_de_sesion('admin') || verificacion_rol_de_sesion('coord') || verificacion_rol_de_sesion('trasoc'))) {
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
        echo "<a href='./usuarios.php'> Ir a la lista de usuarios</a>";
        echo " | ";
        echo " <a href='./logout.php'>Salir</a>";
        ?>
    </div>
</header>