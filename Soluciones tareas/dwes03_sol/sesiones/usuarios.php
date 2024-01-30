<?php
require_once __DIR__ . '/session_control.php';
require_once __DIR__ . '/etc/conf.php';
require_once __DIR__ . '/src/conn.php';
require_once __DIR__ . '/src/dbfuncs.php';
require_once __DIR__ . '/src/userauth.php';

if (tieneRol(ROL_ADMIN) || tieneRol(ROL_COORD) || tieneRol(ROL_EDUSOC) || tieneRol(ROL_TRASOC)) :

    $inactivos = filter_input(INPUT_POST, 'inactivos', FILTER_SANITIZE_SPECIAL_CHARS);
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);

    //ÚLTIMO FILTRO USADO
    if (is_string($nombre))
        $_SESSION['form_filtro_usuarios']['nombre'] = $nombre;
    else
        $nombre = $_SESSION['form_filtro_usuarios']['nombre'] ?? '';
    //FIN ÚLTIMO FILTRO USADO

    $pdo = connect();
    $usuarios = usuarios($pdo, activos: ($inactivos === "si" ? false : true), filtro: $nombre);

else:
    $error="No tiene permisos para mostrar esta sección";
endif;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de usuarios</title>
    <link rel="stylesheet" href="styles/dwes02.css">

</head>

<body>
    <?php
    include 'extra/header.php';
    ?>
    <form action="" method="post">
        <H2>Filtrar datos</H2>
        <label>Mostrar usuarios inactivos: <input type="checkbox" name="inactivos" value="si" <?= $inactivos === "si" ? "checked" : "" ?>>(si no se marca, se mostrarán los usuarios activos)</label><br>
        <label>Filtrar usuarios: <input type="text" name="nombre" value="<?= $nombre ?? "" ?>"></label><br>
        <input type="submit" value="¡Filtrar!">
    </form>
    <?php if (is_array($usuarios) && count($usuarios) > 0) : ?>
        <h1>Usuarios asociación Respira</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>DNI</th>
                <th>Fecha de Nacimiento</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <?php if (!tieneRol(ROL_EDUSOC)) : ?>
                    <th>Acciones</th>
                <?php endif; ?>

            </tr>
            <?php foreach ($usuarios as $u) : ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= $u['dni'] ?></td>
                    <td><?= date('d/m/Y', strtotime($u['fnacim'])) ?></td>
                    <td><?= $u['nombre'] ?></td>
                    <td><?= $u['apellidos'] ?></td>
                    <?php if (!tieneRol(ROL_EDUSOC)) : ?>
                        <td>
                            <form action="detalleusuario.php" method="post">
                                <input type="submit" value="Ver detalle">
                                <input type="hidden" name="idusuario" value="<?= htmlspecialchars($u['id']) ?>">
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif (isset($error)) : ?>
        <?=$error?>
    <?php else : ?>
        La búsqueda no genero resultados.
    <?php endif; ?>
</body>

</html>