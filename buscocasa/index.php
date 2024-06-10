<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>BUSCO CASA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">

    </head>
    
    <body>
   
    <?php
                require_once("header.php");
                ?>
<h1 class="fw-bold mb-3 border-bottom border-5 w-75 mx-auto">Inmuebles</h1>
    <section class="container my-5">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php
                require_once("conexion.php");
                $data = $cnx->query("SELECT Calle,Ciudad,MetrosCuadrados,SituacionInmueble,LinkMaps,Foto FROM inmuebles ORDER BY IDInmueble");
                while ($row = $data->fetch_assoc()) {
                    extract($row);
                    echo "<div class='col'>
                    <div class='card'>
                        <img src='$Foto' class='card-img-top' alt='Calle'>
                        <div class='card-body'>
                            <h5 class='card-title'>$Calle</h5>
                            
                            <h5 class='card-title'>$Ciudad</h5>
                            
                            <div class='card-footer w-75'>
                            <a href='$LinkMaps' target='_blank'>Ver en Google Maps</a>
                            </div>
                            </div>
                            </div>
                            </div>";
                            }
                            ?>
                            <!-- <iframe src='$LinkMaps' width='600' height='450' style='border:0;' allowfullscreen='' loading='lazy'></iframe> -->
        </div>
    </section>
    <section class="container">
        <h2>Buscar por provincia</h2>
    <form name="lista1" id="lista1">
        <select name="listProvincia" id="listProvincia" class="form-select w-50 border-dark">
            <option value="0" selected>TODAS LAS Provincias</option>
            <?php
                require_once("conexion.php");
                $data = $cnx->query("SELECT * FROM provincias ORDER BY NombreProvincia");
                while ($row = $data->fetch_assoc()) {
                    extract($row);
                    echo "<option value='$IDProvincia'>$IDProvincia-- $NombreProvincia</option>";
                }
            ?>
        </select>
    </form>
            </section>
    <section class="my-2 w-75 mx-auto">
        <table id="tablamostrar" class="table">
            
            <thead>
                <tr>
                    
                    <th>Provincia</th>
                    <th>Calle</th>
                    <th>Foto</th>
                    <th>Situacion</th>
                    <th>Precio Alquiler</th>
                    <th>Precio Venta</th>
               
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once("conexion.php");
                    $data = $cnx->query("SELECT * FROM inmuebles i,provincias p where i.IDProvincia= P.IDProvincia ORDER BY IDInmueble");
                    while ($row = $data->fetch_assoc()) {
                        extract($row);
                        echo "<tr><td>$NombreProvincia</td><td>$Calle</td><td>$Foto</td><td>$SituacionInmueble</td><td>$PrecioAlquiler</td><td>$PrecioVenta</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </section>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/jsbuscocasa.js"></script>
</body>

</html>