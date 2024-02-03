<form action="" method="post">
<table>
<thead>
    <tr><th>id</th><th>Nombre</th><th>Teléfono</th><th>Eliminar</th></tr>    
</thead>
<?php foreach($_SESSION['datos'] as $id=>$registro): ?>
    <tr><th><?=$id?></th><th><?=$registro['nombre']?></th><th><?=$registro['telefono']?></th>
    <th><input type="checkbox" name="eliminar[]" value="<?=$id?>" id=""></th></tr>    
<?php endforeach;?>
</table>
<input type="submit" value="Eliminar!">
</form>