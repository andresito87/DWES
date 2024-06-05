<?php
require_once __DIR__ . '/conectar2.php';
header("Content-type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $SQL = <<<ENDSQL
    SELECT propietarios.id, propietarios.nombre, 
    propietarios.apellidos FROM propietarios
ENDSQL;
    $resultado = $pdo->query($SQL); // Puedo usar query porque no hay datos externos que puedan modificar la consulta, si no usar prepare y bindValue
    echo json_encode($resultado->fetchAll(PDO::FETCH_ASSOC));

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Leemos los datos "RAW" recibidos desde php://input que es donde se envian los datos en formato JSON
    $datos = file_get_contents("php://input");
    // decodificar los datos JSON recibidos y, si son correctos, guardarlos.
    $json = json_decode($datos, true);
    if ($json !== null) {
        if (! isset($json['codigocomunidad']) || empty($json['codigocomunidad'])) {
            $error[] = "Falta codigo comunidad";
        }
        if (! isset($json['cuota']) || empty($json['cuota']) || ! is_numeric($json['cuota'])) {
            $error[] = "Falta cuota";
        }
        if (! isset($json['localizacion']) || empty($json['localizacion'])) {
            $error[] = "Falta localizacion";
        }
        if (! isset($json['id_propietario']) || empty($json['id_propietario']) || ! preg_match('/^\d+$/', $json['id_propietario'])) {
            $error[] = "Falta id propietario";
        }
        if (! isset($error)) {
            $sql = "INSERT INTO pisos (codigocomunidad, localizacion, cuota, id_propietario) 
        VALUES (:codigocomunidad, :localizacion, :cuota, :id_propietario)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($json);
            if ($stmt->rowCount() === 1)
                echo json_encode(['RESULTADO' => "OK"]);
            else
                echo json_encode(['RESULTADO' => "ERROR"]);
        } else {
            echo json_encode(['ERROR' => $error], JSON_PRETTY_PRINT);
        }
    }
}
