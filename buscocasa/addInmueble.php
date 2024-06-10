<?php
session_start();
if (!isset($_SESSION["login"]) && !isset($_SESSION["nombre"])) {
    header("Location: admin.php");
}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>ME HUNDO TU AGENCIA DE VIAJES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
    <?php
    require_once ("header.php");
    require_once ("headerAdmin.php");
    ?>
    <div class="container mt-3 bg-light">
        <nav aria-label="breadcrumb" class="ms-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a href="adminindex.php" class="text-dark">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Agregar Inmueble</li>
            </ol>
        </nav>
    </div>
    <section class="w-75 mx-auto my-5">
        <div class="mt-2 text-bg-primary text-center poetsen-one-regular">
            Alta de inmuebles
        </div>
        <div class="bg-white p-3">
            <form id="formagrcasa" name="formagrcasa" enctype="multipart/form-data">
                <div class="row row-cols-sm-1 row-cols-lg-2 ">

                    <div class="col mb-3">
                        <label class="form-label">Calle</label>
                        <input type="text" name="calle" id="calle" required class="form-control border-primary w-75">
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">Ciudad</label>
                        <input type="text" name="ciudad" id="ciudad" required class="form-control border-primary w-75">
                    </div>
                </div>
                <div class="row row-cols-sm-1 row-cols-lg-2 mb-5 ">

                    <div class="col mb-3">
                        <label class="form-label">CP</label>
                        <input type="int" name="cp" id="cp" required class="form-control border-primary w-75">
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">IDProvincia</label>
                        <select name="provincia" id="provincia" required class="form-select w-75 border-primary">
                            <option value="" disabled selected>Selecciona una provincia</option>
                            <?php
                            require_once ("conexion.php");
                            $data = $cnx->query("SELECT * FROM provincias ORDER BY NombreProvincia");
                            while ($row = $data->fetch_assoc()) {
                                extract($row);
                                echo "<option value='$IDProvincia'>$NombreProvincia</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row row-cols-lg-1 mb-3">
                    <div class="col">
                        <label class="form-label">Metros Cuadrados<span class="text-danger">*</span></label>
                        <input type="number" name="MetrosCuadrados" id="MetrosCuadrados" required min="1"
                            class="form-control border-primary">
                    </div>


                    <div class="row row-cols-lg-3">
                        <div class="col">
                            <label class="form-label">Número de habitaciones<span class="text-danger">*</span></label>
                            <input type="number" name="habitaciones" id="habitaciones" required min="1"
                                class="form-control border-primary">
                        </div>
                        <div class="col">
                            <label class="form-label ">Número de baños<span class="text-danger">*</span></label>
                            <input type="number" name="servicios" id="servicios" required min="1"
                                class="form-control border-primary">
                        </div>
                        <div class="col">
                            <label class="form-label ">Año de construccion<span class="text-danger">*</span></label>
                            <input type="number" name="fechaconst" id="fechaconst" required min="1900" max="2024"
                                class="form-control border-primary">
                        </div>


                    </div>
                    <div class="row row-cols-lg-1">

                        <div class="mb-3">
                            <label class="form-label">Imagen Articulo</label>
                            <input type="file" name="imagen" id="imagen" required
                                class="form-control border-primary w-75" value="">
                            <button type="button" id="load" class="btn btn-dark mt-2">Previsualizar foto</button>
                        </div>
                        <div class="row">

                            <figure class="my-2  ">
                                <img src="images/nophoto.png" name="imgFoto" id="imgFoto" alt="no foto">


                            </figure>
                        </div>
                        <div class="row row-cols-lg-2">
                            <div class="col">

                                <label for="link" class="form-label">Link Google Maps<span
                                        class="text-danger">*</span></label>
                                <input type="url" name="link" id="link" required maxlength="2048"
                                    class="form-control border-primary">

                            </div>
                            <div class="col">
                                <label class="form-label">Tipo Inmueble<span class="text-danger">*</span></label>
                                <select name="situacion" id="situacion" required class="form-select border-primary">
                                    <option value="" disabled selected>Selecciona el tipo</option>
                                    <option value="ALQUILER">ALQUILER</option>
                                    <option value="VENTA">VENTA</option>
                                </select>
                            </div>

                        </div>
                        <div class="row row-cols-lg-2 ">
                                <div class="col oculto" id="precalq" >
                                    <label class="form-label">Precio Alquiler<span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="precioalquiler" id="precioalquiler"  step="any" min="0"
                                        class="form-control border-primary">
                                    
                                </div>
                                <div class="col oculto" id="precvent" >
                                    <label class="form-label">Precio Venta<span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="precioventa" id="precioventa"  step="any" min="0"
                                        class="form-control border-primary">
                                    
                                </div>
                            
                        </div>
                        
                        <div class="row mb-3">
            <div class="col-md-6">
                <label  class="form-label">Referencia Catastral<span class="text-danger">*</span></label>
                <label class="form-label "><a href="https://www.sedecatastro.gob.es/" target="_blank">Ir al catastro</a></label>
                <input type="text" name="refcatastral" id="refcatastral" maxlength="255" required class="form-control border-primary">
               
            </div>
            <div class="col-md-6">
                <label  class="form-label">Reservada<span class="text-danger">*</span></label>
                <div class="form-check">
                    <input class="form-check-input border-primary" type="radio" name="reservada" id="reservadaSI" value="SI" onclick="toggleReserva(true)" >
                    <label class="form-check-label" >Sí</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input border-primary" type="radio" name="reservada" id="reservadaNO" value="NO" onclick="toggleReserva(false)" checked >
                    <label class="form-check-label" >No</label>
                </div>
               
            </div>
        </div>
        <div id="reservaDetails" class="oculto">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fechaReserva" class="form-label">Fecha de Reserva<span class="text-danger">*</span></label>
                    <input type="date" name="fechareserva" id="fechareserva" class="form-control border-primary">
                   
                </div>
                <div class="col-md-6">
                    <label class="form-label">Importe de la Reserva<span class="text-danger">*</span></label>
                    <input type="number" name="importereserva" id="importereserva" min="0" class="form-control border-primary">
                  
                </div>
            </div>
        </div>
                    <button type="submit" class="btn btn-dark">Insertar Registro</button>

            </form>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="js/moment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jsbuscocasa.js"></script>
</body>

</html>