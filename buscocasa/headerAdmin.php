<section class="container-fluid bg-dark text-white">
        <div class="row justify-content-between py-2">
            <div class="col">
                Usuario: <?php echo $_SESSION['nombre']; ?>
            </div>
            <div class="col hoy text-end">

            </div>
        </div>
    </section>
    <h3>Zona de administración</h3>
    <section class="container">

<nav class="navbar navbar-expand-lg bg-body-tertiary opacity-75 ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="images/iconocasa.png" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav-fill navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-uppercase" aria-current="page" href="adminindex.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="addInmueble.php">Agregar Inmueble</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-uppercase" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Buscar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="listaDestinos.php">Por Destino</a></li>
                        <li><a class="dropdown-item" href="listaMedioTransporte.php">Por medio transporte</a></li>
                        <li><a class="dropdown-item" href="listaFechas.php">Por fechas</a></li>
                        <li>
                            <li><a class="dropdown-item" href="listaPrecios.php">Por precios</a></li>    
                          
                        <li><a class="dropdown-item" href="listaOfertas.php">En oferta</a></li>
                        <li><a class="dropdown-item" href="listaPreciosOfertas.php">Precios en oferta</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="closeSesion.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
</section>