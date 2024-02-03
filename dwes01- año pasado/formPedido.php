<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para efectuar un pedido</title>
</head>
<body>
    <?php
        if (isset($errores) && count($errores)>0)
        {
            ?>
            <h1>Errores:</h1>
            <ul>
                <?php
                    array_walk($errores, function($err) {echo "<LI>$err</LI>";});
                ?>
            </ul>
            <?php
        }
        if (isset($pedido['lineas']))
        {
            reset($pedido['lineas']);
        }
    ?>
    <form action="" method="post">
        <fieldset>
            <legend>Datos cliente:</legend>
        <label for="clientnum">Número de cliente:<input type="text" name="clientnum" id="clientnum" value='<?=$pedido['cliente']??''?>'></label>
        <label for="fechaent">Fecha de entrega:<input type="text" name="fechaent" id="fechaent" value='<?=$pedido['fecha_entrega']??''?>'></label>
        </fieldset>
        <fieldset>
            <legend>Datos Pedido</legend>
            <table>
                <tr>
                   <th>
                    Producto
                   </th>
                   <th>
                    Unidades
                   </th>
                </tr>
                <?php 
                    $masLineas=isset($pedido['lineas']) && count($pedido['lineas'])>0;                    
                    if ($masLineas!==false)
                            $masLineas=current($pedido['lineas']);  
                    for ($i=0;$i<10;$i++):
                        if ($masLineas!==false)
                            extract($masLineas);       
                        else{
                            $producto='';
                            $unidades='';
                        }
                ?>
                <tr>
                    <td>
                        <select name="codigoProducto[]" id="codigoProducto" style="width:500px" >
                            <?=generarOptions($productos,$producto);?>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="unidades[]" id="unidades" value="<?=$unidades?>">                        
                    </td>
                </tr>
                <?php
                    if ($masLineas!==false)
                        $masLineas=next($pedido['lineas']);                  
                    
                    endfor; ?>
                </table>
        </fieldset>
        <fieldset style="text-align:center">
            <input type="submit" value="¡Enviar pedido!">
            <input type="reset" value="Resetear formulario">
        </fieldset>
    </form>
</body>
</html>
