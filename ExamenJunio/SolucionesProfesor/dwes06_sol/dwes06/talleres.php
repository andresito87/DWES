<?php

require 'vendor/autoload.php';

$ubicacion=filter_input(INPUT_GET,'ubicacion',FILTER_VALIDATE_INT);
$status=null;
$data=null;
if ($ubicacion!==null && $ubicacion!==false)
{
    $client = new GuzzleHttp\Client(['base_uri'=>'http://localhost:8080/api/','http_errors'=>false]);
    $response = $client->request('GET', 'ubicaciones/'.$ubicacion.'/talleres');
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
    <title>Talleres</title>
</head>
<body>
    <?php if ($status===200 && $data!==null): ?>
    <?php if (empty($data)): ?>
        <h2>No hay talleres para la ubicación <?=$ubicacion?></h2>
    <?php else: ?>
    <table border=1>
        <thead>
            <tr>
                <TH>Id</TH><TH>Nombre</TH><TH>Descripcion</TH><TH>Día de la semana</TH>
                <TH>Hora de inicio</TH><TH>Hora de fin</TH><TH>Cupo máximo</TH>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $taller) : ?>
            <tr>                
                <Td><?=$taller['id']?></Td><Td><?=$taller['nombre']?></Td><Td><?=$taller['descripcion']?></Td>
                <Td><?=$taller['dia_semana']?></Td><Td><?=$taller['hora_inicio']?></Td><Td><?=$taller['hora_fin']?></Td>
                <Td><?=$taller['cupo_maximo']?></Td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    <?php elseif ($status===404 && $data!==null ): ?>
        <h2>ERROR: <?=$data['error']?>
    <?php elseif ($ubicacion===null): ?>
        <h2>No se ha indicado la ubicación de la que obtener el listado de talleres.</h2>
        <P>
            Recuerda poner http://localhost/dwes06/talleres.php?ubicacion=...
        </P>
    <?php elseif ($ubicacion===false): ?>
        <h2>Debe indicar un entero como ubicacion.</h2>
    <?php endif; ?>
</body>
</html>
