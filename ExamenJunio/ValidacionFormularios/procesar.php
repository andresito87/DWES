<?php
require 'config.php';

// Función para insertar un usuario en la base de datos
function insertUser($pdo, $nombre, $apellidos, $edad)
{
    $sql = "INSERT INTO usuarios (nombre, apellidos, edad) VALUES (:nombre, :apellidos, :edad)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindValue(':apellidos', $apellidos, PDO::PARAM_STR);
    $stmt->bindValue(':edad', $edad, PDO::PARAM_INT);
    $stmt->execute();
}

// Función para obtener todos los usuarios
function getAllUsers($pdo)
{
    $sql = "SELECT * FROM usuarios";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT);

    $errors = [];

    // Validación de datos
    if ($nombre === false || empty($nombre) || strlen($nombre) < 3 || strlen($nombre) > 50) {
        $errors[] = "Nombre inválido.";
    }
    if ($apellidos === false || empty($apellidos || strlen($apellidos) < 3 || strlen($apellidos) > 50)) {
        $errors[] = "Apellidos inválidos.";
    }
    if ($edad === false || $edad <= 0 || $edad >= 150) {
        $errors[] = "Edad inválida.";
    }

    if (empty($errors)) {
        insertUser($pdo, $nombre, $apellidos, $edad);
        $users = getAllUsers($pdo);
    } else {
        echo "<h3>Errores:</h3>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
</head>

<body>
    <h1>Lista de Usuarios</h1>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Edad</th>
        </tr>
        <?php if (! empty($users)) : ?>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= htmlspecialchars($user['nombre']) ?></td>
                    <td><?= htmlspecialchars($user['apellidos']) ?></td>
                    <td><?= htmlspecialchars($user['edad']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>

</html>