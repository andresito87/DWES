<header class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    Usuario: 
                    <?php
                        echo $_SESSION['nombre'];
                    ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Familias
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="addFamily.php">Añadir Famlias</a></li>
                                <li><a class="dropdown-item" href="#">Mostrar Familias</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Artículos
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="addArticulos.php">Añadir Artículos</a></li>
                                <li><a class="dropdown-item" href="listaArticulosFamilia.php">Mostrar Artículos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="closeSesion.php">Cerrar Sesión</a>
                        </li>
                        
                    </ul>
                   
                </div>
            </div>
        </nav>
    </header>