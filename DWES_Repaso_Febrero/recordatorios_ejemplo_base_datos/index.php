<?php

$conn = require 'conectar.php';
require 'functions.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_SPECIAL_CHARS);
$datos['recordar_hasta'] = filter_input(INPUT_POST, 'recordar_hasta', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$datos['titulo'] = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$datos['detalle'] = filter_input(INPUT_POST, 'detalle', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$errors = [];
//
if ($accion === "modificar") {
    $datos=getRecordatorio($conn,$id);
    $datos['recordar_hasta']=DateTime::createFromFormat('Y-m-d H:i:s', $datos['recordar_hasta'])->format('d/m/Y H:i');
} else {
    $recordar_hasta_d = DateTime::createFromFormat('d/m/Y H:i', $datos['recordar_hasta']);
    if ($recordar_hasta_d === false || $recordar_hasta_d->getLastErrors()) {
        $errors[] = "La fecha no es correcta";
        unset($datos['recordar_hasta']);
    } else {
        $datos['recordar_hasta'] = $recordar_hasta_d->format('Y-m-d H:i:s');
    }

    if (!is_string($datos['titulo']) || strlen($datos['titulo']) == 0) {
        $errors[] = "El titulo no es correcto";
        unset($datos['titulo']);
    }

    var_dump($errors);
    if (!$errors) {
        if (is_numeric($id)) {
            modRecordatorio($conn, $id, $datos);
            unset($datos);
        } elseif (is_null($id)) {
            addRecordatorio($conn, $datos);
            unset($datos);
        }
    }
}

//addRecordatorio($conn,['recordar_hasta'=>'2024-01-30 12:00:01','titulo'=>'test1','detalle'=>'ejemplo detalle1']);
//2	2024-01-30 12:00:01	test1	ejemplo detalle1
//modRecordatorio($conn, 2, ['recordar_hasta'=>'2024-01-30 12:00:01','titulo'=>'test_test_test_1','detalle'=>'ejemplo detalle1']);
$resultados = getRecordatorios($conn, false);


?>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Recordar hasta</th>
            <th>Titulo</th>
            <th>Detalle</th>
            <th>Modificar</th>
        </tr>
    </thead>
    <?php
    foreach ($resultados as $resultado) :
    ?>
        <tr>
            <td><?= $resultado['id'] ?></td>
            <td><?= $resultado['recordar_hasta'] ?></td>
            <td><?= $resultado['titulo'] ?></td>
            <td><?= $resultado['detalle'] ?></td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $resultado['id'] ?>">
                    <input type="hidden" name="accion" value="modificar">
                    <input type="submit" value="Modificar">
                </form>
            </td>
        </tr>
    <?php
    endforeach;
    ?>
</table>
<BR>
<BR>
<?php
include 'form.part.php';
?>