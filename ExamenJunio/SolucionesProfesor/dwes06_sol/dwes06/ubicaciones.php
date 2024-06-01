<?php

require 'vendor/autoload.php';

$client = new GuzzleHttp\Client(['http_errors'=>false]);

$response = $client->request('GET', 'http://localhost:8080/api/ubicaciones');

$json = $response->getBody()->getContents();

$status= $response->getStatusCode();
$data = json_decode($json, true);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubicaciones disponibles</title>
</head>
<body>
    <?php if ($status===200 || $data!==null): ?>
    <table border=1>
        <thead>
            <tr>
                <TH>Id</TH><TH>Nombre</TH><TH>Descripcion</TH><TH>Días</TH>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $ubicacion) : ?>
            <tr>                
                <Td><?=$ubicacion['id']?></Td><Td><?=$ubicacion['nombre']?></Td><Td><?=$ubicacion['descripcion']?></Td><Td><?=join(' / ', $ubicacion['dias']);?></Td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <h2>No se ha podido obtener el listado de ubicaciones.</h2>
    <?php endif; ?>
</body>
</html>
