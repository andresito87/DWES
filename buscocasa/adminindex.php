<?php
session_start();
if (!isset($_SESSION["login"]) && !isset($_SESSION["nombre"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>BUSCOCASA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
    <?php
    require_once ("header.php");
    require_once ("headerAdmin.php");
    ?>
 <h1 class="fw-bold mb-3 border-bottom border-5 w-75 mx-auto">Inmuebles</h1>
    <section class="my-2 w-75 mx-auto">
        <table id="tablainmuebles" class="table">
            
            <thead>
                <tr>
                    <th class="oculto">Codigo</th>
                    <th>Calle</th>
                    <th>Foto</th>
                    <th>Situacion</th>
                    <th>Precio Alquiler</th>
                    <th>Precio Venta</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once("conexion.php");
                    $data = $cnx->query("SELECT * FROM inmuebles ORDER BY IDInmueble");
                    while ($row = $data->fetch_assoc()) {
                        extract($row);
                        echo "<tr><td class='oculto'>$IDInmueble</td><td class='col-1''>$Calle</td><td class='col-1'><img class='img-fluid ' src='$Foto' alt='Imagen del inmueble'></td><td>$SituacionInmueble</td><td>$PrecioAlquiler</td><td>$PrecioVenta</td><td><a href='editarInmueble.php?id=$IDInmueble' class='btn btn-primary'>EDITAR</a></td><td><button type='button' class='btn btn-danger btnEliminar'>ELIMINAR</button></td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
        <script src="js/jsbuscocasa.js"></script>
    
        <script src="js/data.js"></script>
</body>

</html>