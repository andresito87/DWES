<?php
require_once __DIR__ . '/conectar.php';

$SQL = 'SELECT p.id, p.codigocomunidad, p.localizacion, p.cuota, pr.nombre, pr.apellidos FROM pisos as p, propietarios as pr WHERE p.id_propietario=pr.id ';
/*$SQL = <<<ENDSQL
SELECT p.id, p.codigocomunidad, p.localizacion, p.cuota, pr.nombre, pr.apellidos FROM pisos as p, propietarios as pr WHERE p.id_propietario=pr.id '
ENDSQL;*/

// Si se ha pasado un id de propiedad, filtramos por él
if (isset($_GET['idprop']) && preg_match('/^\d+$/', $_GET['idprop'])) {
    $SQL .= ' and pr.id = :id';
    // Guardamos el id en un array asociativo para bindearlo
    $datos['id'] = intval($_GET['idprop']);
}

$stmt = $pdo->prepare($SQL);
if (isset($datos))
    foreach ($datos as $key => $value) {
        $stmt->bindValue($key, $value);
    }
$stmt->execute();
$props = $stmt->fetchAll();
?>
<table border="1">
    <tr>
        <th>ID Piso</th>
        <th>Código Comunidad</th>
        <th>Localización</th>
        <th>Cuota</th>
        <th>Propietario</th>
    </tr>
    <?php foreach ($props as $propiedad) : ?>
        <tr>
            <td><?= $propiedad['id'] ?></td>
            <td><?= $propiedad['codigocomunidad'] ?></td>
            <td><?= $propiedad['localizacion'] ?></td>
            <td><?= $propiedad['cuota'] ?></td>
            <td><?= $propiedad['apellidos'] ?>, <?= $propiedad['nombre'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>