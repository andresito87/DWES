<?php
require_once 'conf.php';
session_start();
if (! isset($_SESSION['recuento']))
    $_SESSION['recuento'] = [];

$texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$reiniciar = filter_input(INPUT_POST, 'reiniciar', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (is_string($texto)) {
    $palabras = preg_split('/[\s,.?¿\"\'!:;]+/', $texto);
    foreach ($palabras as $palabra) {
        $palabra = strtolower($palabra);
        foreach (PALABRAS as $tipo => $listatipo) {
            if (! isset($_SESSION['recuento'][$tipo]))
                $_SESSION['recuento'][$tipo] = 0;
            if (in_array($palabra, $listatipo))
                $_SESSION['recuento'][$tipo]++;
        }
    }
} elseif (is_string($reiniciar) && $reiniciar === 'si') {
    foreach ($_SESSION['recuento'] as &$r) {
        $r = 0;
    }
}

?>

<form action="" method="post">
    Introduce tu texto:<br><textarea name="texto" id="" cols="30" rows="10"></textarea><BR>
    <input type="submit" value="¡Contar!">
</form>
<br><br>
<form action="" method="post">
    <input type="hidden" name="reiniciar" value="si">
    <input type="submit" value="¡Reiniciar Recuento!">
</form>

<?php if (isset($_SESSION['recuento'])) : ?>
    <H2>Recuento </H2>
    <ul>
        <?php foreach ($_SESSION['recuento'] as $key => $r) : ?>
            <li><strong><?= $key ?></strong>: <?= $r ?> apariciones</li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>