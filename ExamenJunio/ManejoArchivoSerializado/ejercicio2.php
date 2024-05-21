<?php
require_once 'funciones.php';
// Con la tabla de datos del ejercicio 1, filtrar los datos por codigo postal y eliminar los filtros con el boton resetear filtros

session_start();
if (isset($_POST['codigo_postal'])) {
    $_SESSION['filtros']['codigo_postal'] = $_POST['codigo_postal'];
}

if (isset($_POST['limpiar_filtros'])) {
    unset($_SESSION['filtros']);
}

$datosEsperados = ['nombre_empresa', 'codigo_postal', 'nombre_contacto', 'correo', 'telefono', 'areas'];
$areasDisponibles = ['diseno_web', 'diseno_movil', 'diseno_escritorio', 'admin_sistemas'];
var_dump($_POST);
if (empty($diff = array_diff($datosEsperados, array_keys($_POST)))) {
    echo "PROCESAR";
    if (! preg_match('/^\d{5}$/', $_POST['codigo_postal'])) {
        $errors[] = "El código postal no es válido";
    }

    if (! empty(array_diff($_POST['areas'], $areasDisponibles))) {
        $errors = "Las areas seleccionadas no son válidas";
    }
} else {
    $errors = "Faltan los campos " . implode(",", $diff);
}

if (empty($errors)) {
    var_dump($_POST);
    guardarEmpresa($_POST);
}

$empresas = cargarEmpresas();

if (isset($_GET['eliminar_empresa'])) {
    borrarEmpresa($_GET['eliminar_empresa']);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method='post'>
        Código Postal:
        <input type="text" name="codigo_postal">
        <input type="submit" value="filtrar">
    </form>
    <form action="" method='post'>
        Limpiar filtro:
        <input type="hidden" value="limpiar_filtros">
        <input type="submit" value="Resetear campos">
    </form>
    <table>
        <thead>
            <tr>
                <th>Nombre empresa</th>
                <th>Código Postal</th>
                <th>Nombre Contacto</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Áreas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (! isset($_POST['codigo_postal'])) {
                if (isset($empresas) && ! empty($empresas))
                    foreach ($empresas as $empresa) : ?>
                        <tr>
                            <td><?= $empresa['nombre_empresa'] ?></td>
                            <td><?= $empresa['codigo_postal'] ?></td>
                            <td><?= $empresa['nombre_contacto'] ?></td>
                            <td><?= $empresa['correo'] ?></td>
                            <td><?= $empresa['telefono'] ?></td>
                            <td><?php implode(',', $empresa['areas']) ?></td>
                            <td>
                                <a
                                    href="<?= $_SERVER['PHP_SELF'] ?>?eliminar_empresa=<?= urlencode($empresa['nombre_empresa']) ?>">Eliminar</a>

                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php
            } else {
                if (isset($empresas) && ! empty($empresas))
                    foreach ($empresas as $empresa) :
                        if ($empresa['codigo_postal'] == $_SESSION['filtros']['codigo_postal']) {
                            ?>
                            <tr>
                                <td><?= $empresa['nombre_empresa'] ?></td>
                                <td><?= $empresa['codigo_postal'] ?></td>
                                <td><?= $empresa['nombre_contacto'] ?></td>
                                <td><?= $empresa['correo'] ?></td>
                                <td><?= $empresa['telefono'] ?></td>
                                <td><?php implode(',', $empresa['areas']) ?></td>
                                <td>
                                    <a
                                        href="<?= $_SERVER['PHP_SELF'] ?>?eliminar_empresa=<?= urlencode($empresa['nombre_empresa']) ?>">Eliminar</a>

                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    <?php endforeach ?>
                <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>