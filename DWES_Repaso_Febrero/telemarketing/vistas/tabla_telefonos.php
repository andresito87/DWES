<form action="" method="post">
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <?php foreach ($_SESSION['datos'] as $id => $registro) : ?>
            <tr>
                <td><?= $id ?></td>
                <td><?= $registro['nombre'] ?></td>
                <td><?= $registro['telefono'] ?></td>
                <td><input type="checkbox" name="eliminar[]" value="<?= $id ?>" id=""></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <input type="submit" value="Eliminar!">
</form>