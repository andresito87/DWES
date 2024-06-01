<?php
require 'vendor/autoload.php';
// No se incluye funciones_acceso_servicio_web.php porque está en "composer.json" > autoload->files
// si no se pone en "composer.json" si debería aparecer aquí:
// include 'funciones_acceso_servicio_web.php';

if (file_exists(DATOS))
    $datos = unserialize(file_get_contents(DATOS));
else
    $datos = [];

if (isset($_FILES['fichero_usuario'])) {
    if ($_FILES['fichero_usuario']['error'] == UPLOAD_ERR_OK) {

        if (count($datos) > 5) {
            echo 'Ya se han subido 5 archivos. Debe eliminar alguno.';
        } else {            
            $hash256 = hash_file('sha256', $_FILES['fichero_usuario']['tmp_name']);
            if (in_array($hash256, array_column($datos, 'HASH256'))) {
                echo "<H2>Ya está el archivo subido.</H2>";
            } else {
                $newtmpname = CARPETA_SUBIDAS . DIRECTORY_SEPARATOR . uniqid() . '-' . basename($_FILES['fichero_usuario']['tmp_name']);

                $resultado = move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $newtmpname);
                if ($resultado) {
                    
                    $datos_archivo = $_FILES['fichero_usuario'];
                    $datos_archivo['tmp_name'] = $newtmpname;
                    $datos_archivo['HASH256'] = $hash256;
                    $datos_archivo['estado'] = 'no_enviado_a_virus_total';
                    $datos[] = $datos_archivo;
                }
            }
        }
    } 
    else // $_FILES['fichero_usuario']['error']!=UPLOAD_ERR_OK
    {
        echo 'Se ha producido un error al subir el archivo. Es posible qeu sea más grande que el tamaño máximo permitido';
    }
}

if (isset($_POST['delete']))
{
    if (($pos=array_search($_POST['delete'], array_column($datos, 'HASH256')))!==false) {
        unlink($datos[$pos]['tmp_name']);
        unset($datos[$pos]);
    }
}
if (isset($_POST['subirarchivo']))
{
    if (($pos=array_search($_POST['subirarchivo'], array_column($datos, 'HASH256')))!==false) {
        if ($datos[$pos]['estado']==='no_enviado_a_virus_total')
        {
            $resultado=enviarArchivoAVerificar($datos[$pos]['tmp_name'],$datos[$pos]['type']);
            if ($resultado['status']===200)
            {
                echo "<H1>Archivo enviado a analizar: {$datos[$pos]['name']}</H1>";                
                echo "<PRE>";
                print_r($resultado);
                echo "</PRE>";
                $datos[$pos]['estado']='ya_enviado_a_virus_total';
                $datos[$pos]['id']=$resultado['content']->data->id;
            }
        }
        else{
            echo "El archivo ya ha sido enviado para su análisis.";
        }
    }
    else
    {
        echo "El archivo no existe";
    }    
}

if (isset($_POST['resultadosEscaneo']))
{
    if (($pos=array_search($_POST['resultadosEscaneo'], array_column($datos, 'HASH256')))!==false) {
        if ($datos[$pos]['estado']==='ya_enviado_a_virus_total')
        {
            $resultado=obtenerEstadoVerificacion($datos[$pos]['HASH256']);
            if ($resultado['status']===200)
            {
                echo "<H1>Resultado del escaneo {$datos[$pos]['name']}</H1>";                
                include ("mostrar_resultados_escaneo.php");                           
            }
            else
            {
                echo "<H2>No parece que la operación se haya realizado</H2>";
                print_r($resultado);
            }            
        }
        else{
            echo "El archivo NO ha sido enviado para su análisis o NO ha empezado a ser procesado.";
        }
    }
    else
    {
        echo "El archivo no existe";
    }    
}

include('mostrar_archivos.php');
file_put_contents(DATOS, serialize($datos));

?>
<form enctype="multipart/form-data" action="" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
    Envia el fichero para analizar: <input name="fichero_usuario" type="file" />
    <BR>
    <input type="submit" value="Enviar fichero" />
</form>