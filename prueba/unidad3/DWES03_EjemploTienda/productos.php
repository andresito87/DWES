<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/funciones/util.php';

// Recuperamos la información de la sesión
session_start();

// Y comprobamos que el usuario se haya autentificado
if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='login.php'>identificarse</a>.<br />");
}

//Conectamos con la base de datos.
$pdo = conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 3 : Desarrollo de aplicaciones web con PHP -->
<!-- Ejemplo Tienda Web: productos.php -->
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Ejemplo Tema 3: Listado de Productos</title>
    <link href="tienda.css" rel="stylesheet" type="text/css">
</head>

<body class="pagproductos">

    <div id="contenedor">
        <div id="encabezado">
            <h1>Listado de productos</h1>
        </div>
        <div id="cesta">
            <h3><img src="cesta.jpg" alt="Cesta" width="24" height="21"> Cesta</h3>
            <hr />
            <?php
            // Comprobamos si se ha enviado el formulario de vaciar la cesta
            if (isset($_POST['vaciar'])) {
                unset($_SESSION['cesta']);
            }

            // Comprobamos si se ha enviado el formulario de añadir
            // si es así, añadimos el producto a la lista de productos de la cesta
            if (isset($_POST['enviar'])) {
                $codProd = filter_input(INPUT_POST, 'producto', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if (is_string($codProd)) {
                    $prodSQL = <<<'SQL'
                SELECT nombre_corto, PVP
                FROM producto
                WHERE cod=:codProd
            SQL;
                    $stmt = $pdo->prepare($prodSQL);
                    $stmt->bindValue('codProd', $codProd);
                    if ($stmt->execute()) {
                        if (($datos = $stmt->fetch()) !== false) {
                            $producto['nombre'] = $datos['nombre_corto'];
                            $producto['precio'] = $datos['PVP'];
                            $_SESSION['cesta'][$codProd] = $producto;
                        }
                    }
                }
            }

            // Si la cesta está vacía, mostramos un mensaje
            
            if ((!isset($_SESSION['cesta'])) || (count($_SESSION['cesta']) == 0)) {
                print "<p>Cesta vacía</p>";
                $cesta_vacia = true;
            }

            // Si no está vacía, mostrar su contenido
            else {
                foreach ($_SESSION['cesta'] as $codigo => $producto)
                    print "<p>$codigo</p>";
                $cesta_vacia = false;
            }
            ?>
            <form id='vaciar' action='productos.php' method='post'>
                <input type='submit' name='vaciar' value='Vaciar Cesta' <?php if ($cesta_vacia) {
                    print "disabled='true'";
                } ?> />
            </form>
            <form id='comprar' action='cesta.php' method='post'>
                <input type='submit' name='comprar' value='Comprar' <?php if ($cesta_vacia) {
                    print "disabled='true'";
                } ?> />
            </form>
        </div>
        <div id="productos">
            <?php


            $sql = <<<'SQL'
        SELECT cod, nombre_corto, PVP
        FROM producto
    SQL;

            $resultado = $pdo->query($sql);
            if ($resultado) {
                // Creamos un formulario por cada producto obtenido
                $row = $resultado->fetch();
                while ($row != null): ?>

                    <p>
                    <form id='<?= $row['cod'] ?>' action='productos.php' method='post'>
                        <input type='hidden' name='producto' value='<?= $row['cod'] ?>' />
                        <input type='submit' name='enviar' value='Añadir' />
                        <?= $row['nombre_corto'] ?>:
                        <?= $row['PVP'] ?> euros
                    </form>
                    </p>
                    <?php
                    $row = $resultado->fetch();
                endwhile;
            }
            ?>

        </div>
        <br class="divisor" />
        <div id="pie">
            <form action='logoff.php' method='post'>
                <input type='submit' name='desconectar'
                    value='Desconectar usuario <?php echo $_SESSION['usuario']; ?>' />
            </form>
        </div>
    </div>
</body>

</html>