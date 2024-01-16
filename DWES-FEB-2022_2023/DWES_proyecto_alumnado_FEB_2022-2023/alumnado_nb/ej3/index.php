<?php    
    $posiciones=['4-3','6-7','0-0','9-9'];//Valores de prueba para ser eliminados.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <style>
        td {
            border:1px solid green;
            min-width: 30px;
            height: 30px;   
            text-align: center;
            vertical-align: middle;         
        }
        .blue {
            background-color: lightblue;
        }
    </style>
</head>
<body>
    <?php if(isset($mensaje)):?>
            <h2><?=$mensaje?></h2>
    <?php endif; ?>
    <table>
        
        <tr>
            <th></th>
            <?php  for ($x=0;$x<10;$x++): ?>
            <th><?=$x?></th>
            <?php endfor;?>
        </tr>
        <?php  for ($y=0;$y<10;$y++): ?>
        <tr>
            <th><?=$y?></th>
            <?php  
                for ($x=0;$x<10;$x++): 
                if (in_array($x.'-'.$y,$posiciones)) 
                    $class='blue';
                else 
                    $class='';
                ?>
            <td class='<?=$class?>'>
                <?=$class?"x":""?>
            </td>
            <?php endfor; ?>    
        </tr>
        <?php endfor; ?>
    </table>
    <form action="" method="post">
        <label for="x">Posicion x: <input type="text" name="x" id="x"></label><br>
        <label for="y">Posicion y: <input type="text" name="y" id="x"></label><br>
        <input type="submit" value="Marcar">
    </form>
    <form action="" method="post">
        <input type="hidden" name="op" value="limpiar">
        <input type="submit" value="Limpiar Tablero">
    </form>
</body>
</html>