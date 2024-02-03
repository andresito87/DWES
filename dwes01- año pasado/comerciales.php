<?php

require_once('etc/conf.php');

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comerciales de WetWater S.L.</title>
    <style>
        .amigo {
            padding: 10px;
            border: 1px solid green;
            background-color: lightgreen;
            text-align: center;
            font-weight: bold;
            font-size: 1.3em;
        }
        .comercial
        {
            margin: 10px;
            padding: 10px;
            background: aqua;
        }
        .enlaces
        {
            margin: 10px;
            padding: 10px;
        }
    </style>
</head>
<body>
<H1>Nuestros comerciales</H1>
<?php

include ('amigo.php');

$noMostrarEnlaceDeComercial=0;

if (isset($_GET['comercial']))
{
    echo "<div class='comercial'>";
    switch ($_GET['comercial'])
    {
        case COMERCIAL1:
                readfile('frag/comercial1.html');
                $noMostrarEnlaceDeComercial=1;
            break;
        case COMERCIAL2:
                include('frag/comercial2.html');
                $noMostrarEnlaceDeComercial=2;
            break;
        case COMERCIAL3:
                include('frag/comercial3.html');
                $noMostrarEnlaceDeComercial=3;
            break;
        case COMERCIAL4:
                include('frag/comercial4.html');
                $noMostrarEnlaceDeComercial=4;
            break;
        default:
                echo 'Comercial no encontrado.';
            break;
    }
    echo '</div>';
}

?>
<div class="enlaces">
Haz clic a continuación en uno de los siguientes enlaces para obtener información de nuestros comerciales:<BR>
<UL>
<?php
    if ($noMostrarEnlaceDeComercial!=1) echo '<li><A href="?comercial='.urlencode(COMERCIAL1).'">'.htmlentities(COMERCIAL1).'</A><BR></li>';
    if ($noMostrarEnlaceDeComercial!=2) echo '<li><A href="?comercial='.urlencode(COMERCIAL2).'">'.htmlentities(COMERCIAL2).'</A><BR></li>';
    if ($noMostrarEnlaceDeComercial!=3) echo '<li><A href="?comercial='.urlencode(COMERCIAL3).'">'.htmlentities(COMERCIAL3).'</A><BR></li>';
    if ($noMostrarEnlaceDeComercial!=4) echo '<li><A href="?comercial='.urlencode(COMERCIAL4).'">'.htmlentities(COMERCIAL4).'</A><bR></li>';
?>
</UL>
</div>

<?php include ('amigo.php'); ?>
    
</body>
</html>