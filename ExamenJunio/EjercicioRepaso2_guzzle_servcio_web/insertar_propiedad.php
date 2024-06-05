<?php
require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

// URL del servicio web
define('URL', 'http://localhost/dwes/webservice.php');

// Creamos un cliente HTTP que no muestre excepciones por errores
$e = new Client(['http_errors' => false]);
if (! empty($_POST)) {

    // Creamos un objeto con los datos a enviar
    $datos = new stdClass;
    $datos->codigocomunidad = $_POST['codigocomunidad'] ?? '';
    $datos->localizacion = $_POST['localizacion'] ?? '';
    $datos->cuota = $_POST['cuota'] ?? '';
    $datos->id_propietario = $_POST['id_propietario'] ?? '';
    $res = $e->post(URL,
        [
            'json' => $datos
        ]
    );
    $datosRecibidos = $res->getBody()->getContents();
    var_dump($datosRecibidos);
} else {
    $res = $e->get(URL);
    $datosRecibidos = $res->getBody()->getContents();
    $datosPropietarios = json_decode($datosRecibidos, true);
}
?>

<?php if (isset($datosPropietarios)) : ?>
    <form action="insertar_propiedad.php" method="post">
        <label for="codigocomunidad">Código Comunidad:</label>
        <input type="text" id="codigocomunidad" name="codigocomunidad"><br><br>

        <label for="localizacion">Localización:</label>
        <input type="text" id="localizacion" name="localizacion"><br><br>

        <label for="cuota">Cuota:</label>
        <input type="text" id="cuota" name="cuota"><br><br>

        <label for="id_propietario">Propietario:</label>
        <select id="id_propietario" name="id_propietario">
            <?php foreach ($datosPropietarios as $prop) : ?>
                <option value="<?= $prop['id'] ?>"><?= $prop['apellidos'] ?>, <?= $prop['nombre'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="submit" value="Insertar Piso">
    </form>
<?php endif; ?>