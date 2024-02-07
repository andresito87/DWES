<?php
/*5. Muestra los datos de una tabla en un formato de lista paginada*/
/*
 * Datos de conexión con la base de datos.
 */
define('DB_DSN', 'mysql:host=localhost;dbname=prueba');
define('DB_USER', 'root');
define('DB_PASSWD', '');
define('ELEM_PAG', 3);

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

function actualizarRecordatorio(PDO $conn, $id, $datos)
{
    $datosesperados = ['recordar_hasta', 'titulo', 'detalle'];
    if (count(array_diff($datosesperados, array_keys($datos))) > 0) {
        echo "Datos no esperados";
        return -1;
    }
    try {
        $SQL = "UPDATE recordatorios SET recordar_hasta=:recordar_hasta, titulo=:titulo, detalle=:detalle WHERE id=:id";
        $stmt = $conn->prepare($SQL);
        $stmt->bindValue(":recordar_hasta", $datos['recordar_hasta']);
        $stmt->bindValue(":titulo", $datos['titulo']);
        $stmt->bindValue(":detalle", $datos['detalle']);
        $stmt->bindValue(":id", $id);
        if ($stmt->execute()) {
            return $stmt->rowCount();
        }
    } catch (PDOException $e) {
        var_dump($e);
    }
    return false;
}


$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$recordar_hasta = filter_input(INPUT_POST, "recordar_hasta", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$titulo = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$detalle = filter_input(INPUT_POST, "detalle", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$inicio = filter_input(INPUT_POST, "inicio", FILTER_VALIDATE_INT);

if (!is_int($inicio)) {
    $inicio = 0;
}


if (isset($_POST["actualizar"]) && $_POST["actualizar"] == "Actualizar") {
    $datos = array(
        "recordar_hasta" => $recordar_hasta,
        "titulo" => $titulo,
        "detalle" => $detalle
    );
    $resultadoActualizado = actualizarRecordatorio($conexion, $id, $datos);
    if (!$resultadoActualizado) {
        echo "Error en el intento de actualización del registro";
    } else {
        echo "Registro Actualizado correctamente";
    }
}

function subconjunto(array $datos, int $inicio, int $length): array
{
    $cont = 0;
    $nuevo_array = [];
    foreach ($datos as $key => $val) {
        if ($cont >= $inicio && $cont < $inicio + $length) {
            $nuevo_array[$key] = $val;
        }
        $cont++;
        if ($cont >= $inicio + $length) break;
    }
    return $nuevo_array;
}

function mostrarDatos($array)
{
    echo "<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Categoria</th>
        </tr>
    </thead>";

    foreach ($array as $recordatorio) {
        $fechaFormateada = date('Y-m-d', strtotime($recordatorio['recordar_hasta'])); //Formateada para ser cargada en el html, tipo Date
        echo '<tr>
                <form action="ejercicio3.php" method="post">
                    <td>' . $recordatorio["id"] . '</td>
                    <input type="hidden" name="id" value="' . $recordatorio['id'] . '">
                    <td><input type="date" name="recordar_hasta" value="' . $fechaFormateada . '"></td>
                    <td><input type="text" name="titulo" value="' . $recordatorio['titulo'] . '"></td>
                    <td><input type="text" name="detalle" value="' . $recordatorio['detalle'] . '"></td>
                    <td><input type="submit" name="actualizar" value="Actualizar"></td>
                </form>
            </tr>';
    }


    echo "</table>";
}


$recordatorios = getRecordatorios($conexion);
$subconjuntoDatos = subconjunto($recordatorios, $inicio, ELEM_PAG);
//var_dump($subconjuntoDatos);
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
    <?php mostrarDatos($subconjuntoDatos); ?>
    <?php
    if ($inicio - ELEM_PAG >= 0) : ?>
        <form action="ejercicio5.php" method="post">
            <input type="hidden" name="inicio" value="<?= $inicio - ELEM_PAG ?>">
            <input type="submit" value="Ver los <?= ELEM_PAG ?> anteriores">
        </form>
    <?php endif ?>

    <br>
    <?php if ($inicio + ELEM_PAG < count($recordatorios)) : ?>
        <form action="ejercicio5.php" method="post">
            <input type="hidden" name="inicio" value="<?= $inicio + ELEM_PAG ?>">
            <input type="submit" value="Ver los <?= ELEM_PAG ?> siguientes">
        </form>
    <?php endif ?>

</body>

</html>