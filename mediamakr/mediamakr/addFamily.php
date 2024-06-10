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
    <link href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>

    <?php
        require_once("headerAdmin.php");
    ?>

    <section class="w-75 mx-auto my-5 border border-dark rounded p-3">
        <form name="AddFamily" id="AddFamily">
            <div class="row rows-col-2 align-items-center">
                <div class="col">
                    <label class="form-label">Nombre Familia</label>
                    <input type="text" name="familia" id="familia" required class="form-control w-75 border-primary">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-dark">GRABAR</button>
                </div>
            </div>
        </form>
    </section>
    <section class="my-2 w-75 mx-auto">
        <table id="tablaFamilias" class="table">
            <thead>
                <tr>
                    <th>Cód.Familia</th>
                    <th>Familia</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once("conectar.php");
                    $data = $cnx->query("SELECT * FROM familias ORDER BY NombreFamilia");
                    while ($row = $data->fetch_assoc()) {
                        extract($row);
                        echo "<tr><td class='col-1''>$IDFamilia</td><td>$NombreFamilia</td><td><a href='editarFamilia.php?id=$IDFamilia' class='btn btn-primary'>EDITAR</a></td><td><a href='eliminarFamilia.php?id=$IDFamilia' class='btn btn-danger'>ELIMINAR</a></td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="js/administracion.js"></script>
    <script src="js/data.js"></script>
</body>

</html>