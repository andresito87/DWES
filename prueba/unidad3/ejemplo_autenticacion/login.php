<!DOCTYPE html>
<html lang="es">

<body>
    <?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        define('DBUSER', 'root');
        define('DBPWD', '');
        define('DBNAME', 'dwes');

        if ($_POST) {
            $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pwd = filter_input(INPUT_POST, 'pwd');
        } else {
            $resultado = "¿Listo para iniciar sesión?";
        }

        if (isset($usuario) && isset($pwd) && is_string($usuario) && is_string($pwd)) {
            try {
                $pdo = new PDO('mysql:host=localhost;dbname=' . DBNAME, DBUSER, DBPWD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'ERROR DB: ' . $e->getMessage();
                exit;
            }
            try {
                $hashPwd = hash('sha256', $pwd);
                $sql = 'SELECT usuario from usuarios where usuario=:usuario and contrasena=:hashPwd';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':usuario', $usuario);
                $stmt->bindValue(':hashPwd', $hashPwd);
                if ($stmt->execute()) {
                    $usuario = $stmt->fetchColumn();
                    if ($usuario !== false) {
                        $_SESSION['usuario'] = $usuario;
                        $_SESSION['login_timestamp'] = time();
                        $resultado = "Bienvenido {$usuario}, gracias por autenticarte.";
                    } else
                        $resultado = "No se ha podido autenticar al usuario.";
                }
            } catch (PDOException) {
                $resultado = "Se ha producido una excepción al autenticar al usuario.";
            }
        } elseif ($_POST)
            $resultado = "Parece que no se han recibido todos los datos.. ¡ups!";
    } else {
        if (time() - $_SESSION['login_timestamp'] > 600) {
            $resultado = "Hace más de 10 minutos que entraste, tienes que volver a iniciar sesión.";
            unset($_SESSION['login_timestamp']);
            unset($_SESSION['usuario']);
        } else {
            $_SESSION['login_timestamp'] = time();
            $resultado = "Gracias por volver a tiempo. Encantado de saludarte {$_SESSION['usuario']} otra vez. Renovamos el tiempo de usuario.";
        }
    }

    ?>

    <H2>
        <?= $resultado ?? '' ?>
    </H2>
    <?php if (!isset($_SESSION['usuario'])): ?>
        <form action="" method="post">
            <label for="usuario">Usuario: <input type="text" name="usuario" id="usuario"></label><BR>
            <label for="pwd">Contraseña: <input type="password" name="pwd" id="pwd"></label><BR>
            <input type="submit" value="¡Iniciar sesión!">
        </form>
    <?php else: ?>
        <form action="logout.php" method="post">
            <input type="submit" value="Cerrar Sesión">
        </form>
    <?php endif; ?>

</body>

</html>