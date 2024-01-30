<header>
<?=$_SESSION['empleado']['nombre']?> <?=$_SESSION['empleado']['apellidos']?> [ROLES: <?=$_SESSION['empleado']['roles']?>]
<?php if (isset($_SESSION['form_detalle_usuario']['idusuario'])): ?>
    <A href="detalleusuario.php">Ver detalles último usuario consultado </A> | 
<?php endif; ?>
<A href="usuarios.php">Ir a lista de usuarios</A> | <A href="logout.php">Salir</A> 
</header>