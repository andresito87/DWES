<?php if (isset($errores)) : ?>
    <UL>
        <?php
        foreach ($errores as $error) {
            echo "<LI>$error</LI>";
        }
        ?>
    </UL>
<?php endif; ?>

<h2>Insertar Nuevo Propietario</h2>
<form action="insertar_propietario.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?= $old['nombre'] ?? '' ?>"><br><br>

    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" value="<?= $old['apellidos'] ?? '' ?>"><br><br>

    <label for="edad">Edad:</label>
    <input type="number" id="edad" name="edad" value="<?= $old['edad'] ?? '' ?>"><br><br>

    <input type="submit" value="<?= $accion ?? 'Insertar Propietario' ?>">
</form>