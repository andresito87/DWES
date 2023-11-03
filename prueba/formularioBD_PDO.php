<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "
http://www.w3.org/TR/html4/loose.dtd">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 3 : Trabajar con bases de datos en PHP -->
<!-- Ejemplo: Conjuntos de datos con PDO -->
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Ejercicio Tema 3: Conjuntos de resultados en PDO</title>
    <link href="dwes.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="encabezado">
        <h1>Ejercicio: Conjuntos de resultados en PDO</h1>
        <form id="form_seleccion" action="." method="post">
            <span>Producto: </span>
            <select name="producto">
                <?php
                if (isset($_POST['producto']))
                    $producto = $_POST['producto'];
                // Rellenamos el desplegable con los datos de todos los productos
                $dwes = new PDO("mysql:host=localhost;dbname=dwes", "dwes", "abc123.");
                $sql = "SELECT cod, nombre_corto FROM producto";
                $resultado = $dwes->query($sql);
                if ($resultado) {
                    $row = $resultado->fetch();
                    while ($row != null) {
                        echo "<option value='{$row['cod']}'";
                        // Si se recibió un código de producto lo seleccionamos
                        // en el desplegable usando selected='true'
                        if (isset($producto) && $producto == $row['cod'])
                            echo " selected='true'";
                        echo ">{$row['nombre_corto']}</option>";
                        $row = $resultado->fetch();
                    }
                }
                ?>
            </select>
            <input type="submit" value="Mostrar stock" name="enviar" />
        </form>
    </div>
    <div id="contenido">
        <h2>Stock del producto en las tiendas:</h2>
        <?php
        // Si se recibió un código de producto
        // mostramos el stock de ese producto en las distintas tiendas
        if (isset($producto)) {
            $sql = <<<SQL
                        SELECT tienda.nombre, stock.unidades
                        FROM tienda INNER JOIN stock ON tienda.cod=stock.tienda
                        WHERE stock.producto='$producto'
                    SQL;
            $resultado = $dwes->query($sql);
            if ($resultado) {
                $row = $resultado->fetch();
                while ($row != null) {
                    echo "<p>Tienda {$row['nombre']}: {$row['unidades']} unidades.</p>";
                    $row = $resultado->fetch();
                }
            }
        }
        ?>
    </div>
    <div id="pie">
        <?php
        unset($dwes);
        ?>
    </div>
</body>

</html>