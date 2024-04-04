<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

$idUbicacion = $_GET['ubicacion'];
$cliente = new Client(['http_errors' => false]);
$response = $cliente->request('GET', 'http://127.0.0.1:8000/api/ubicaciones/' . $idUbicacion . '/talleres');
$status = $response->getStatusCode(); //Código de estado HTTP retornado en la petición HTTP
?>
<h3>Estado retornado por la petición:
    <?= $status ?>
</h3>
<?php
if ($status == 404) {
    $body = json_decode($response->getBody(), true);
    echo $body['mensaje'];
} else if ($status == 200) {
    $talleres = json_decode($response->getBody(), true);
    if (! empty($talleres)) {
        ?>
            <table border='1'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Día</th>
                        <th>Hora de Inicio</th>
                        <th>Hora de Fin</th>
                        <th>Cupo máximo</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($talleres as $taller) { ?>
                        <tr>
                            <td>
                            <?= $taller['id'] ?>
                            </td>
                            <td>
                            <?= $taller['nombre'] ?>
                            </td>
                            <td>
                            <?= $taller['descripcion'] ?>
                            </td>
                            <td>
                            <?= $taller['dia_semana'] ?>
                            </td>
                            <td>
                            <?= $taller['hora_inicio'] ?>
                            </td>
                            <td>
                            <?= $taller['hora_fin'] ?>
                            </td>
                            <td>
                            <?= $taller['cupo_maximo'] ?>
                            </td>
                        </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php
    } else {
        ?>
            <p>No hay talleres en esta ubicación</p>
        <?php
    }
} else {
    ?>
        <p>Error Desconocido</p>
    <?php
}