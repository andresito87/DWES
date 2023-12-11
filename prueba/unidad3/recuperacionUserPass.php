<?php
// Si no se recibe el nombre de usuario o la contraseña, pedimos las credenciales:
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    header('WWW-Authenticate: Basic realm="Contenido restringido"');
    header("HTTP/1.0 401 Unauthorized");
    exit;
}
// Si ya ha enviado las credenciales, las comprobamos con la base de datos
else {
    // Conectamos a la base de datos utilizando PDO
    $dsn = "mysql:host=localhost;dbname=dwes";
    $username = "root"; //Usuario de la base de datos
    $password = ""; //Contraseña de la base de datos
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    try {
        $pdo = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit;
    }

    // Preparamos la consulta utilizando consultas preparadas y SHA256
    $contrasena = hash('sha256', $_SERVER['PHP_AUTH_PW']);
    $sql = "SELECT usuario FROM usuarios WHERE usuario = :usuario AND contrasena = :hashContrasena";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario', $_SERVER['PHP_AUTH_USER'], PDO::PARAM_STR);
    $stmt->bindParam(':hashContrasena', $contrasena, PDO::PARAM_STR);
    $stmt->execute();

    // Si no existe, se vuelven a pedir las credenciales
    if ($stmt->rowCount() == 0) {
        header('WWW-Authenticate: Basic realm="Contenido restringido"');
        header("HTTP/1.0 401 Unauthorized");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<body>
    <?php
    print "<pre>";
    print_r($_SERVER);
    print_r($_POST);
    print "</pre>";
    echo "Nombre de usuario: " . $_SERVER['PHP_AUTH_USER'] . "<br>";
    echo "Contraseña: " . $_SERVER['PHP_AUTH_PW'] . "<br>";
    echo "Contraseña en SHA256: " . hash('sha256', $_SERVER['PHP_AUTH_PW']) . "<br>";
    ?>
</body>

</html>