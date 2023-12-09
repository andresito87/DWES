<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null;
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">

<head>
</head>

<body>
    <?php if ($usuario !== null): ?>
        <H2>Hasta otra
            <?= $usuario ?>
        </H2>
    <?php else: ?>
        <h2>Ya has cerrado sesión antes, o bien, no la has iniciado.</h2>
    <?php endif; ?>

    <a href="login.php"> ¿Volver a autenticarte? </a>
</body>

</html>