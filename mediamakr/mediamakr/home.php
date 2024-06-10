<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>MEDIAMAKR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <section class="container my-5">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php
                require_once("conectar.php");
                $data = $cnx->query("SELECT IDArticulo,NombreArticulo,foto,PrecioArticulo,Oferta,PrecioOferta FROM articulos ORDER BY NombreArticulo");
                while ($row = $data->fetch_assoc()) {
                    extract($row);
                    echo "<div class='col'>
                    <div class='card'>
                        <img src='$foto' class='card-img-top' alt='$NombreArticulo'>
                        <div class='card-body'>
                            <h5 class='card-title'>$NombreArticulo</h5>
                            <div class='card-footer'>
                                <small class='text-body-secondary'>$PrecioArticulo</small>
                            </div>
                        </div>
                    </div>
                </div>";
                }
            ?>
        </div>
    </section>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>