<style>body {
    background-color: white;
    color: black;
}

.card {
    width: 100%;
    background-color: white;
}

.btn {
    margin-bottom: 10px;
}

.table-responsive {
    max-height: 400px; /* Limita la altura de la tabla para scroll vertical */
    overflow-y: auto; /* Habilita el scroll vertical */
    overflow-x: auto; /* Habilita el scroll horizontal */
    min-width: 100%;
}

/* Bordes estilo Excel */
.table-bordered th,
.table-bordered td {
    border: 2px solid black; /* Bordes de 2px color negro */
}

.table-bordered {
    border-collapse: collapse; /* Asegura que no haya separación entre bordes */
}

.table-hover tbody tr:hover {
    background-color: #f1f1f1; /* Efecto hover en filas */
}

/* Campos de formularios */
.form-control,
.form-select {
    background-color: #333;
    color: white;
    border: 1px solid #444;
}

/* Estilos del footer */
footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    background-color: #b39fc2; /* Color personalizado del footer */
    color: #ffffff; /* Texto blanco */
    padding: 10px 0;
    text-align: center;
}

/* Footer customizado */
footer.custom-footer {
    background-color: #b39fc2; /* Color personalizado para footer */
    color: #ffffff; /* Texto en blanco */
}

/* Navbar customizada */
.navbar-custom {
    background-color: #4c5187; /* Azul personalizado para la navbar */
    color: white; /* Texto blanco en la navbar */
}

/* Botones personalizados */
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-success {
    background-color: #1e00ff;
    border-color: #1e00ff;
}

/* Validaciones */
.is-invalid {
    border-color: #dc3545;
}

.text-danger {
    color: #dc3545 !important;
}

/* Barra lateral de navegación */
.sb-sidenav {
    background-color: grey; /* Fondo oscuro */
}

.sb-sidenav .nav-link {
    color: #4c5187 ; /* Texto blanco */
}

.sb-sidenav .nav-link:hover {
    background-color: #b39fc2; /* Fondo azul en hover */
    color: #f0f0f0; /* Texto claro en hover */
}

.sb-sidenav-footer {
    background-color: #23272a; /* Fondo más oscuro para el footer de la barra lateral */
    color: #c1c1c1; /* Texto más claro */
}

.sb-sidenav-footer .small {
    color: #a1a1a1; /* Color más claro para el texto del footer */
}

    </style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark navbar-custom">
        <a class="navbar-brand ps-3" href="../../../Cliente/HTML/MenuPrincipalCliente.php">SPORTFLEXX</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">    
                    <li><a class="dropdown-item" href="../../../Cliente/HTML/Logout.php">Salir</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-columns"></i>
                            </div>
                            Principal
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="MenuAdmin.php">Inicio</a>
                                <a class="nav-link" href="../../../Cliente/HTML/MenuPrincipalCliente.php">SPORTFLEXX</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            Paginas
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="clientes.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                        Clientes
                                    </a>
                                    <a class="nav-link" href="Productos.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                                        Productos
                                    </a>
                                    <a class="nav-link" href="Productos_variantes.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                                        Productos Variantes
                                    </a>
                                    <a class="nav-link" href="Categoria.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                                        Categorías
                                    </a>
                                    <a class="nav-link" href="Pedido.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                        Pedidos
                                    </a>
                                    <a class="nav-link" href="Ventas.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign"></i></div>
                                        Ventas
                                    </a>
                                </nav>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReports"
                            aria-expanded="false" aria-controls="collapseReports">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            Reportes
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseReports" aria-labelledby="headingThree"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="ventasPorFecha.php">Ventas por Fecha</a>
                                <a class="nav-link" href="ventasPorCategoria.php">Ventas por Categoría</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>