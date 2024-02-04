<form action="" method="post">
    Recorda hasta: <input type="text" name="recordar_hasta" value="<?=$datos['recordar_hasta']??''?>" id=""><BR>
    Titulo: <input type="text" name="titulo" value="<?=$datos['titulo']??''?>" id=""><BR>
    Detalle: <BR>
    <textarea name="detalle"><?=$datos['detalle']??''?></textarea>
    <?php if(isset($datos['id'])): ?>
    <input type="hidden" name="id" value="<?=$datos['id']?>">
    <input type="submit" value="¡Modificar!">
    <?php else: ?>
        <input type="submit" value="¡Crear!">
    <?php endif; ?>
    
</form>