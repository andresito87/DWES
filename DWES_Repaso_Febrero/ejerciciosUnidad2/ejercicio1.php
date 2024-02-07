<?php
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

$recordatorios = getRecordatorios($conexion);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            /* Combina los bordes de celdas adyacentes */
            width: 100%;
            /* Opcional: ajusta el ancho de la tabla */
        }

        th,
        td {
            border: 1px solid black;
            /* Establece el borde de 1 píxel sólido */
            padding: 8px;
            /* Agrega espacio dentro de las celdas */
            text-align: left;
            /* Alinea el texto a la izquierda dentro de las celdas */
        }

        th {
            background-color: #f2f2f2;
            /* Color de fondo para las celdas de encabezado */
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <td>id</td>
                <td>Recoradar hasta</td>
                <td>tittulo</td>
                <td>detalles</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recordatorios as $recordatorio) : ?>
                <tr>
                    <td><?= $recordatorio['id'] ?></td>
                    <td><?= $recordatorio['recordar_hasta'] ?></td>
                    <td><?= $recordatorio['titulo'] ?></td>
                    <td><?= $recordatorio['detalle'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>