<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location:administracion.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>MEDIAMAKR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>

    <?php
        require_once("headerAdmin.php");
    ?>
    <section class="w-75 mx-auto my-5">
    <form name="lista1" id="lista1">
        <select name="listFamily" id="listFamily" class="form-select w-50 border-dark">
            <option value="0" selected>TODAS LAS FAMILIAS</option>
            <?php
                require_once("conectar.php");
                $data = $cnx->query("SELECT * FROM familias ORDER BY NombreFamilia");
                while ($row = $data->fetch_assoc()) {
                    extract($row);
                    echo "<option value='$IDFamilia'>$NombreFamilia</option>";
                }
            ?>
        </select>
    </form>
    <section class="my-5">
        <table class="table" id="listaTabla">
            <thead>
                <tr class="text-center">
                    <th>Imagen</th>
                    <th>Referencia</th>
                    <th>Concepto</th>
                    <th>Precio</th>
                    <th><i class="bi bi-pencil"></i></th>
                    <th><i class="bi bi-trash"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once("conectar.php");
                    $data = $cnx->query("SELECT IDArticulo,NombreArticulo,foto,PrecioArticulo,Oferta,PrecioOferta FROM articulos ORDER BY NombreArticulo");
                    while ($row = $data->fetch_assoc()) {
                        extract($row);
                        echo "<tr class='text-center align-middle'><td class='w-25'><img src='$foto' alt='$NombreArticulo' class='img-fluid'></td><td>$IDArticulo</td><td>$NombreArticulo</td>";
                        if ($Oferta == 'S') {
                            echo "<td><span class='text-decoration-line-through'>".number_format($PrecioArticulo,2,",",".")."</span><br><span class='text-danger'>".number_format($PrecioOferta,2,",",".")."</td><td><a href='editarArticulo.php?id=$IDArticulo' class='btn btn-primary'>EDITAR</a></td></td><td><button type='button' class='btn btn-danger btnEliminar'>ELIMINAR</button></td></tr>";
                        }
                        else {
                            echo "<td>".number_format($PrecioArticulo,2,",",".")."<td><a href='editarArticulo.php?id=$IDArticulo' class='btn btn-primary'>EDITAR</a></td><td><button type='button' class='btn btn-danger btnEliminar'>ELIMINAR</button></td></tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </section>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/administracion.js"></script>
</body>

</html>