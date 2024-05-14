<?php
require_once 'funciones.php';

// Validar datos del formulario, guardarlos en un archivo y mostrarlos en una tabla con botón eliminar para cada empresa almacenada

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
    <?php
    if (isset($errors) && ! empty($errors)) {
        var_dump($errors);
    }
    readfile("form.html");
    ?>
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
        </tbody>
    </table>
</body>

</html>