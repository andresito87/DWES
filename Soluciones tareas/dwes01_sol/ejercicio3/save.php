<?php
    //NOTA: los datos del formulario se procesan en el script "save_procesardatospost.php"
    list($datos,$errores)=require 'save_procesardatospost.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <?php
        if ($errores):
    ?>
        <h1>ERRORES:</h1>
        <UL>
            <?php
                array_walk($errores,function ($e) { echo "<LI>$e</LI>";});
            ?>
        </UL>
    <?php
        else:

            $archivo = fopen('datos.csv', 'a');
            if ($archivo===false)
            {
                echo '<H3>ERROR: no se ha podido abrir el archivo datos.csv</H3>';
            }
            else
            {
                fputcsv($archivo, $datos);            
                fclose($archivo); 
                echo "<H3>Datos guardados</H3>";
            }
        endif;
    ?>    
</body>
</html>