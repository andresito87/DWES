<?php
/*2. Crea un formulario HTML para ingresar datos y un script PHP que procese e inserte un nuevo
registro en la base de datos*/
/*1. Realiza una consulta simple para obtener todos los registros de una tabla*/

/*
 * Datos de conexión con la base de datos.
 */
define('DB_DSN', 'mysql:host=localhost;dbname=prueba');
define('DB_USER', 'root');
define('DB_PASSWD', '');

//Función para conectar
function connect()
{
    $pdoConn = false;
    try {
        $pdoConn = new PDO(
            DB_DSN,
            DB_USER,
            DB_PASSWD,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    } catch (PDOException $e) {
        die("Error al conectar con la base de datos.");
    }
    return $pdoConn;
}

$conexion = connect();

$recordar_hasta = filter_input(INPUT_POST, "recordar_hasta", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$titulo = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$detalle = filter_input(INPUT_POST, "detalle", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

//echo $recordar_hasta;
//echo $titulo;
//echo $detalle;

function getRecordatorios(PDO $conn)
{
    try {
        $SQL = "SELECT id,recordar_hasta, titulo, detalle FROM recordatorios";
        $stmt = $conn->prepare($SQL);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC); //Usar FetchAll para obtener todos los registros, no fetch
        }
    } catch (PDOException $e) {
        var_dump($e);
    }
    return false;
}

$datos = array(
    "recordar_hasta" => $recordar_hasta,
    "titulo" => $titulo,
    "detalle" => $detalle
);

if (isset($_POST['enviar']) && $_POST['enviar'] == "Enviar") {
    function insertarRecodatorio(PDO $conn, $datos)
    {
        $datosesperados = ['recordar_hasta', 'titulo', 'detalle'];
        if (count(array_diff($datosesperados, array_keys($datos))) > 0) {
            echo "Datos no esperados";
            return -1;
        }
        try {
            $SQL = "INSERT INTO recordatorios (recordar_hasta, titulo, detalle) VALUES (:recordar_hasta,:titulo,:detalle)";
            $stmt = $conn->prepare($SQL);
            if ($stmt->execute($datos)) {
                return $stmt->rowCount();
            }
        } catch (PDOException $e) {
            var_dump($e);
        }
        return false;
    }
    $resultadoInsercion = insertarRecodatorio($conexion, $datos);
    if ($resultadoInsercion) {
        echo "Insercción de datos realizada correctamente";
    } else {
        echo "Error en la inseción de los datos";
    }
}


$recordatorios = getRecordatorios($conexion);
//var_dump($recordatorios);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>

<body>
    <form action="ejercicio2.php" method="post">
        <label for="recordar_hasta">Recordar Hasta:
            <input type="date" name="recordar_hasta" id="recordar_hasta">
        </label>
        <br>
        <label for="titulo">Título:
            <input type="text" name="titulo" id="titulo">
        </label>
        <br>
        <label for="titulo">Detalle:
            <input type="text" name="detalle" id="detalle">
        </label>
        <br>
        <input type="submit" name="enviar" value="Enviar">
    </form>
</body>

</html>