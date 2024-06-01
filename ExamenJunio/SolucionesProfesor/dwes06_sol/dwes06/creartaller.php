<?php

require 'vendor/autoload.php';

$datos = array();
$datos['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
$datos['descripcion'] = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_SPECIAL_CHARS);
$datos['dia_semana'] = filter_input(INPUT_POST, 'dia_semana', FILTER_SANITIZE_SPECIAL_CHARS);
$datos['hora_inicio'] = filter_input(INPUT_POST, 'hora_inicio', FILTER_SANITIZE_SPECIAL_CHARS);
$datos['hora_fin'] = filter_input(INPUT_POST, 'hora_fin', FILTER_SANITIZE_SPECIAL_CHARS);
$datos['cupo_maximo'] = filter_input(INPUT_POST, 'cupo_maximo', FILTER_VALIDATE_INT);
$ubicacion = filter_input(INPUT_POST, 'ubicacion_id', FILTER_VALIDATE_INT);
$status=null;
$data=null;
if ($ubicacion!==null && $ubicacion!==false)
{
    $client = new GuzzleHttp\Client(['base_uri'=>'http://localhost:8080/api/','http_errors'=>false]);
    $response = $client->request('POST', 'ubicaciones/'.$ubicacion.'/creartaller',['form_params'=>$datos]);
    $json = $response->getBody()->getContents();
    $status= $response->getStatusCode();
    $data = json_decode($json, true);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talleres - Crear taller</title>
</head>
<body>
    <?php if ($status===200 && $data!==null && $data['resultado']=='ok'): ?>
        <H2>Taller creado</H2>
        <?php var_dump($data['datos']); ?>    
    <?php elseif ($status===404 && $data!==null ): ?>
        <h2>ERROR: <?=$data['error']?>
    <?php elseif ($status===422 && $data!==null): ?>
        <H2>Los datos recibidos tienen errores:</H2>
        <ul>
        <?php foreach($data['errores'] as $campo=>$errores): ?>
            <li> Errores en el dato <strong><?=$campo?></strong>:
                <ul>
                <?php foreach($errores as $error): ?>
                    <li>
                        <?=$error?>
                    </li>
                <?php endforeach;?>
                </ul>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php elseif ($ubicacion===null): ?>
        <h2>No se ha indicado la ubicación</h2>
    <?php elseif ($ubicacion===false): ?>
        <h2>Debe indicar un entero como ubicacion.</h2>
    <?php endif; ?>
</body>
</html>
