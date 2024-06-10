<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location:administracion.php");
}
require_once("conectar.php");
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
        <form name="AddArticulo" id="AddArticulo" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nombre Artículo</label>
                <input type="text" name="nombreArticulo" id="nombreArticulo" required class="form-control w-75 border-primary">
            </div>
            <div class="mb-3">
                <label class="form-label">Familia Artículo</label>
                <select name="familiaArticulo" id="familiaArticulo" required class="form-select w-75 border-dark">
                    <option value="" disabled selected>Selecciona una familia</option>
                    <?php
                    $data = $cnx->query("SELECT * FROM familias ORDER BY NombreFamilia");
                    while ($row = $data->fetch_assoc()) {
                        extract($row);
                        echo "<option value='$IDFamilia'>$NombreFamilia</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Precio Artículo</label>
                <input type="number" min="0" name="precioArticulo" id="precioArticulo" required value="0" class="form-control w-25 border-primary text-end">
            </div>
            <div class="row rows-col-2 mb-3 align-items-center">
                <div class="col">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="oferta" name="oferta">
                        <label class="form-check-label">Artículo en Oferta</label>
                    </div>
                </div>
                <div class="col">
                    <label class="form-label">Precio Artículo en Oferta</label>
                    <input type="number" min="0" name="precioOferta" id="precioOferta" required disabled value="0" class="form-control border-primary text-end w-50">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="activo" id="activoS" value="S" checked>
                    <label class="form-check-label">Artículo Activo</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="activo" id="activoN" value="N">
                    <label class="form-check-label">Artículo NO Activo</label>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input type="file" name="imagen" id="imagen" class="form-control w-75 border-dark">
            </div>
            <div class="mb-3">
                <textarea name="observasciones" id="observaciones" placeholder="Observaciones" rows="15" class="form-control w-75 border-dark"></textarea>
            </div>        
            <div class="mb-3">
                <button type="submit" class="btn btn-dark">GRABAR</button>
            </div>
        </form>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="js/administracion.js"></script>
</body>

</html>