<?php
require_once __DIR__ . '/conectar.php';

$SQL = <<<ENDSQL
    SELECT propietarios.id, propietarios.nombre, 
    propietarios.apellidos, propietarios.edad, 
    count(pisos.id_propietario) as num_propiedades
    from propietarios, pisos WHERE propietarios.id = pisos.id_propietario group by propietarios.id;
ENDSQL;

$SQL_TODOS = <<<ENDSQL
    SELECT * FROM propietarios;
ENDSQL;

$resultado = $pdo->query($SQL); //SELECT
//$array=$stmt->fetchAll();
?>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Edad</th>
        <th>Numero de propiedades</th>
        <th>Ver Propiedades</th>
    </tr>
    <?php foreach ($resultado as $prop) : ?>
        <tr>
            <td><?= $prop['id'] ?></td>
            <td><?= $prop['nombre'] ?></td>
            <td><?= $prop['apellidos'] ?></td>
            <td><?= $prop['edad'] ?></td>
            <td><?= $prop['num_propiedades'] ?? "" ?></td>
            <td><A href="ver_propiedades.php?idprop=<?= $prop['id'] ?>">Ver Propiedades</A></td>
        </tr>
    <?php endforeach; ?>
</table>