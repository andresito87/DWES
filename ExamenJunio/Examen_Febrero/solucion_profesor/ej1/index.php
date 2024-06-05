<?php
require_once ('funciones.php');
$estados = leerEstados();
if (isset($_POST['estado'])) {
    $mensaje_motivador = alAzar($_POST['estado']);
}
?>
<?php if ($estados) : ?>
    <h1>¿Cómo te sientes hoy?</h1>
    <form action="" method="post">
        <select name="estado" id="">
            <?php foreach ($estados as $estado) : ?>
                <option value="<?= $estado ?>"><?= $estado ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Enviar!">
    </form>
<?php else : ?>
    No hay estados legibles.
<?php endif; ?>

<?php if (isset($mensaje_motivador) && $mensaje_motivador !== false) : ?>
    <H1>¿Hoy estás <?= $_POST['estado'] ?>? </H1>
    <H2><?= $mensaje_motivador ?> </H2>
<?php elseif (isset($mensaje_motivador)) : ?>
    No ha mensajes motivadores para el estado indicado
<?php endif; ?>