<?php
require_once ('includes/plantilla/header/header.html');
?>

<body>
    <div class="d-flex justify-content-center align-items-center">
        <div class="container shadow p-4 mb-5 bg-body rounded">
            <nav class="navbar navbar-expand-lg navbar navbar-dark bg-primary">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand" href="#">Hidden brand</a>
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item <?php echo (isset($cliActive)) ? 'active' : ''; ?>">
                            <a class="nav-link" href="/clientes/listado">Clientes <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item <?php echo (isset($proActive)) ? 'active' : ''; ?>">
                            <a class="nav-link" href="/productos/listado">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pedidos/listado">Pedidos</a>
                        </li>
                        <?php if(isset($_SESSION['admin']) || isset($_SESSION['vendedor'])){?>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Pagos</a>
                            </li>
                        <?php } ?>
                        <?php if(isset($_SESSION['admin'])){?>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Ventas del Mes</a>
                            </li>
                        <?php } ?>
                    </ul>
                        <form class="form-inline" action="/usuarios/cerrarIngreso" method="post">
                            <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Cerrar Sesión</button>
                    </form>
                </div>
            </nav>
