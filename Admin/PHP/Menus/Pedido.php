<?php
require_once(__DIR__ . "/../coneccion/conector.php");

// Crear objeto de la clase Conectar
$obj = new Conectar();

// Sentencia select con JOIN para obtener los detalles del pedido
$sql = "
    SELECT p.IdPedido, p.IdCliente, p.NumeroPedido, p.Estado, p.FechaPedido, p.FechaEntrega, p.IdCuponDescuento,
           dp.IdDetallePedido, dp.IdProducto, dp.Cantidad, dp.PrecioUnitario, dp.Descuento, prod.Nombre AS NombreProducto
    FROM pedido p
    LEFT JOIN detallepedido dp ON p.IdPedido = dp.IdPedido
    LEFT JOIN producto prod ON dp.IdProducto = prod.IdProducto
";
// Obtener los registros de la tabla pedido y sus detalles
$rsMed = mysqli_query($obj->getConexion(), $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Gestión de Pedidos - SPORTFLEXX</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../estilos/stylesAdmin.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<style>
        body {
            padding-top: 56px;
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
            overflow-x: auto;
            min-width: 100%;
        }
        .modal-content {
            background-color: #2c2c2c;
            color: white;
        }
        .modal-header {
            border-bottom: 1px solid #444;
        }
        .modal-footer {
            border-top: 1px solid #444;
        }
        .form-control {
            background-color: #333;
            color: white;
            border: 1px solid #444;
        }
        .form-select {
            background-color: #333;
            color: white;
            border: 1px solid #444;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #1f1f1f;
            padding: 10px 0;
            text-align: center;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .is-invalid {
            border-color: #dc3545;
        }
        .text-danger {
            color: #dc3545 !important;
        }
    </style>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="../../../Cliente/HTML/MenuPrincipalCliente.php">SPORTFLEXX</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <i class="fas fa-search"></i>
            </div>
        </form>
        <ul classnavbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="../../../Cliente/HTML/Logout.php">Logout</a></li>
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
                            Layouts
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
                            Pages
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
                        <a class="nav-link" href="Categoria.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                            Categorías
                        </a>
                        <a class="nav-link" href="Direccion.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-map-marked-alt"></i></div>
                            Direcciones
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
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Pedidos</h1>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalPedido" onclick="clearForm()">Nuevo Pedido</button>

                    <div class="modal fade" id="modalPedido" tabindex="-1" aria-labelledby="modalPedidoLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalPedidoLabel">Pedido</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario de Pedido -->
                                    <form id="Pedido-form" method="post" action="RegistrarPedido.php">
                                        <input type="hidden" id="IdPedido" name="IdPedido" value="0">
                                        <div class="mb-3">
                                            <label for="cliente-IdCliente">ID Cliente</label>
                                            <input type="text" id="cliente-IdCliente" name="IdCliente" class="form-control" required>
                                            <div class="invalid-feedback" id="cliente-error"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pedido-NumeroPedido">Número de Pedido</label>
                                            <input type="text" id="pedido-NumeroPedido" name="NumeroPedido" class="form-control" required>
                                            <div class="invalid-feedback" id="numero-error"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pedido-Estado">Estado</label>
                                            <input type="text" id="pedido-Estado" name="Estado" class="form-control" required>
                                            <div class="invalid-feedback" id="estado-error"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pedido-FechaPedido">Fecha del Pedido</label>
                                            <input type="date" id="pedido-FechaPedido" name="FechaPedido" class="form-control" required>
                                            <div class="invalid-feedback" id="fechaPedido-error"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pedido-FechaEntrega">Fecha de Entrega</label>
                                            <input type="date" id="pedido-FechaEntrega" name="FechaEntrega" class="form-control" required>
                                            <div class="invalid-feedback" id="fechaEntrega-error"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pedido-IdCuponDescuento">ID Cupón Descuento</label>
                                            <input type="text" id="pedido-IdCuponDescuento" name="IdCuponDescuento" class="form-control" oninput="updateDescuento()">
                                            <div class="invalid-feedback" id="cupon-error"></div>
                                        </div>

                                        <!-- Sección de detallepedido -->
                                        <h5>Detalle del Pedido</h5>
                                        <div class="detalle-pedido-container">
                                            <div class="detalle-pedido mb-3">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="detalle-IdProducto">Producto</label>
                                                        <select id="detalle-IdProducto" name="IdProducto[]" class="form-control" onchange="updatePrecioUnitario(this)">
                                                            <option value="" disabled selected>Selecciona un producto</option>
                                                            <?php
                                                            $sqlProductos = "SELECT IdProducto, Nombre, PrecioUnitario FROM producto";
                                                            $rsProductos = mysqli_query($obj->getConexion(), $sqlProductos);
                                                            while ($producto = mysqli_fetch_array($rsProductos)) {
                                                                echo "<option value='" . $producto['IdProducto'] . "' data-precio='" . $producto['PrecioUnitario'] . "'>" . $producto['Nombre'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="detalle-Cantidad">Cantidad</label>
                                                        <input type="number" name="Cantidad[]" class="form-control" required oninput="updateTotal(this)">
                                                        <div class="invalid-feedback" id="cantidad-error"></div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="detalle-PrecioUnitario">Costo Unitario</label>
                                                        <input type="number" step="0.01" name="PrecioUnitario[]" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="detalle-Descuento">Descuento (%)</label>
                                                        <input type="number" step="0.01" name="Descuento[]" class="form-control" oninput="updateTotal(this)">
                                                        <div class="invalid-feedback" id="descuento-error"></div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="detalle-Total">Total</label>
                                                        <input type="number" step="0.01" name="Total[]" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button" class="btn btn-danger btn-sm mt-4" onclick="removeDetalle(this)">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success mb-3" onclick="addDetalle()">Agregar Detalle</button>
                                        <button type="submit" class="btn btn-primary mt-3">Guardar Pedido</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Pedidos
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>IdPedido</th>
                                        <th>IdCliente</th>
                                        <th>Número de Pedido</th>
                                        <th>Estado</th>
                                        <th>Fecha del Pedido</th>
                                        <th>Fecha de Entrega</th>
                                        <th>IdCuponDescuento</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Costo Unitario</th>
                                        <th>Descuento</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
    <?php
    while ($registro = mysqli_fetch_array($rsMed)) {
        $pedidoData = htmlspecialchars(json_encode($registro), ENT_QUOTES, 'UTF-8');
        echo "<tr>";
        echo "<td>" . $registro['IdPedido'] . "</td>";
        echo "<td>" . $registro['IdCliente'] . "</td>";
        echo "<td>" . $registro['NumeroPedido'] . "</td>";
        echo "<td>" . $registro['Estado'] . "</td>";
        echo "<td>" . $registro['FechaPedido'] . "</td>";
        echo "<td>" . $registro['FechaEntrega'] . "</td>";
        echo "<td>" . $registro['IdCuponDescuento'] . "</td>";
        echo "<td>" . $registro['NombreProducto'] . "</td>";
        echo "<td>" . $registro['Cantidad'] . "</td>";
        echo "<td>" . $registro['PrecioUnitario'] . "</td>";
        echo "<td>" . $registro['Descuento'] . "</td>";
        echo "<td>
                <button class='btn btn-primary btn-sm edit-btn' data-bs-toggle='modal' data-bs-target='#modalPedido' data-pedido='{$pedidoData}'>Editar</button>
                <form method='post' action='EliminarPedido.php' class='d-inline delete-form'>
                    <input type='hidden' name='Pedido-Id' value='" . $registro['IdPedido'] . "'>
                    <button type='submit' class='btn btn-danger btn-sm'>Eliminar</button>
                </form>
              </td>";
        echo "</tr>";
    }
    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; SPORTFLEXX 2024</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
        crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
    <script>
    function updatePrecioUnitario(select) {
        var option = select.options[select.selectedIndex];
        var precioUnitario = option.getAttribute('data-precio');
        var costoUnitarioInput = select.closest('.detalle-pedido').querySelector("input[name='PrecioUnitario[]']");
        costoUnitarioInput.value = precioUnitario;
        updateTotal(select);
    }

    function updateTotal(input) {
        var detalle = input.closest('.detalle-pedido');
        var cantidad = parseFloat(detalle.querySelector("input[name='Cantidad[]']").value) || 0;
        var precioUnitario = parseFloat(detalle.querySelector("input[name='PrecioUnitario[]']").value) || 0;
        var descuento = parseFloat(detalle.querySelector("input[name='Descuento[]']").value) || 0;
        var totalInput = detalle.querySelector("input[name='Total[]']");
        var total = cantidad * precioUnitario * (1 - descuento / 100);
        totalInput.value = total.toFixed(2);
    }

    function updateDescuento() {
        var idCuponDescuento = document.getElementById("pedido-IdCuponDescuento").value;
        if (idCuponDescuento) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "ObtenerDescuento.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    var response = JSON.parse(this.responseText);
                    var descuentoPorcentaje = response.DescuentoPorcentaje * 100; // Convertir a porcentaje
                    var descuentoInputs = document.querySelectorAll("input[name='Descuento[]']");
                    descuentoInputs.forEach(function(input) {
                        input.value = descuentoPorcentaje;
                    });
                    var cantidadInputs = document.querySelectorAll("input[name='Cantidad[]']");
                    cantidadInputs.forEach(function(input) {
                        updateTotal(input);
                    });
                }
            };
            xhr.send("IdCuponDescuento=" + idCuponDescuento);
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        const editButtons = document.querySelectorAll(".edit-btn");
        editButtons.forEach(button => {
            button.addEventListener("click", (event) => {
                const pedido = JSON.parse(event.currentTarget.getAttribute("data-pedido"));
                loadPedidoData(pedido);
            });
        });

        const deleteForms = document.querySelectorAll(".delete-form");
        deleteForms.forEach(form => {
            form.addEventListener("submit", (event) => {
                event.preventDefault();
                const confirmation = confirm("¿Está seguro de que desea eliminar este Pedido?");
                if (confirmation) {
                    form.submit();
                }
            });
        });

        // Validaciones en tiempo real
        document.getElementById("cliente-IdCliente").addEventListener("input", function () {
            if (isNaN(this.value)) {
                this.classList.add("is-invalid");
                document.getElementById("cliente-error").textContent = "El ID del cliente debe ser un número.";
            } else {
                this.classList.remove("is-invalid");
                document.getElementById("cliente-error").textContent = "";
            }
        });

        document.getElementById("pedido-NumeroPedido").addEventListener("input", function () {
            if (this.value.trim() === "") {
                this.classList.add("is-invalid");
                document.getElementById("numero-error").textContent = "El número de pedido es obligatorio.";
            } else {
                this.classList.remove("is-invalid");
                document.getElementById("numero-error").textContent = "";
            }
        });

        document.getElementById("pedido-Estado").addEventListener("input", function () {
            if (this.value.trim() === "") {
                this.classList.add("is-invalid");
                document.getElementById("estado-error").textContent = "El estado es obligatorio.";
            } else {
                this.classList.remove("is-invalid");
                document.getElementById("estado-error").textContent = "";
            }
        });

        document.getElementById("pedido-FechaPedido").addEventListener("input", function () {
            if (this.value.trim() === "") {
                this.classList.add("is-invalid");
                document.getElementById("fechaPedido-error").textContent = "La fecha del pedido es obligatoria.";
            } else {
                this.classList.remove("is-invalid");
                document.getElementById("fechaPedido-error").textContent = "";
            }
        });

        document.getElementById("pedido-FechaEntrega").addEventListener("input", function () {
            if (this.value.trim() === "") {
                this.classList.add("is-invalid");
                document.getElementById("fechaEntrega-error").textContent = "La fecha de entrega es obligatoria.";
            } else {
                this.classList.remove("is-invalid");
                document.getElementById("fechaEntrega-error").textContent = "";
            }
        });

        document.getElementById("pedido-IdCuponDescuento").addEventListener("input", function () {
            if (isNaN(this.value)) {
                this.classList.add("is-invalid");
                document.getElementById("cupon-error").textContent = "El ID del cupón debe ser un número.";
            } else {
                this.classList.remove("is-invalid");
                document.getElementById("cupon-error").textContent = "";
            }
        });
    });

    function loadPedidoData(pedido) {
        document.getElementById("IdPedido").value = pedido.IdPedido;
        document.getElementById("cliente-IdCliente").value = pedido.IdCliente;
        document.getElementById("pedido-NumeroPedido").value = pedido.NumeroPedido;
        document.getElementById("pedido-Estado").value = pedido.Estado;
        document.getElementById("pedido-FechaPedido").value = pedido.FechaPedido;
        document.getElementById("pedido-FechaEntrega").value = pedido.FechaEntrega;
        document.getElementById("pedido-IdCuponDescuento").value = pedido.IdCuponDescuento;
        
        var detallePedidoContainer = document.querySelector(".detalle-pedido-container");
        detallePedidoContainer.innerHTML = ""; // Clear existing details

        if (pedido.detalles) {
            pedido.detalles.forEach(detalle => {
                var detalleDiv = document.createElement('div');
                detalleDiv.classList.add('detalle-pedido', 'mb-3');
                detalleDiv.innerHTML = `
                    <div class='row'>
                        <div class='col-md-3'>
                            <label for='detalle-IdProducto'>Producto</label>
                            <select id='detalle-IdProducto' name='IdProducto[]' class='form-control' onchange='updatePrecioUnitario(this)'>
                                <option value='${detalle.IdProducto}' selected>${detalle.NombreProducto}</option>
                                ${getProductosOptions(detalle.IdProducto)}
                            </select>
                        </div>
                        <div class='col-md-2'>
                            <label for='detalle-Cantidad'>Cantidad</label>
                            <input type='number' name='Cantidad[]' class='form-control' value='${detalle.Cantidad}' required oninput='updateTotal(this)'>
                        </div>
                        <div class='col-md-2'>
                            <label for='detalle-PrecioUnitario'>Costo Unitario</label>
                            <input type='number' step='0.01' name='PrecioUnitario[]' class='form-control' value='${detalle.PrecioUnitario}' readonly>
                        </div>
                        <div class='col-md-2'>
                            <label for='detalle-Descuento'>Descuento (%)</label>
                            <input type='number' step='0.01' name='Descuento[]' class='form-control' value='${detalle.Descuento}' oninput='updateTotal(this)'>
                        </div>
                        <div class='col-md-2'>
                            <label for='detalle-Total'>Total</label>
                            <input type='number' step='0.01' name='Total[]' class='form-control' value='${(detalle.Cantidad * detalle.PrecioUnitario * (1 - detalle.Descuento / 100)).toFixed(2)}' readonly>
                        </div>
                        <div class='col-md-1'>
                            <button type='button' class='btn btn-danger btn-sm mt-4' onclick='removeDetalle(this)'>Eliminar</button>
                        </div>
                    </div>`;
                detallePedidoContainer.appendChild(detalleDiv);
            });
        }
    }

    function getProductosOptions(selectedId) {
        var options = '';
        <?php
        $sqlProductos = "SELECT IdProducto, Nombre, PrecioUnitario FROM producto";
        $rsProductos = mysqli_query($obj->getConexion(), $sqlProductos);
        while ($producto = mysqli_fetch_array($rsProductos)) {
            echo "options += `<option value='{$producto['IdProducto']}' data-precio='{$producto['PrecioUnitario']}' " . ($producto['IdProducto'] == "' + selectedId + '" ? "selected" : "") . ">{$producto['Nombre']}</option>`;";
        }
        ?>
        return options;
    }

    function clearForm() {
        document.getElementById("IdPedido").value = 0;
        document.getElementById("cliente-IdCliente").value = '';
        document.getElementById("pedido-NumeroPedido").value = '';
        document.getElementById("pedido-Estado").value = '';
        document.getElementById("pedido-FechaPedido").value = '';
        document.getElementById("pedido-FechaEntrega").value = '';
        document.getElementById("pedido-IdCuponDescuento").value = '';

        var detallePedidoContainer = document.querySelector(".detalle-pedido-container");
        detallePedidoContainer.innerHTML = `
            <div class="detalle-pedido mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <label for="detalle-IdProducto">Producto</label>
                        <select id="detalle-IdProducto" name="IdProducto[]" class="form-control" onchange="updatePrecioUnitario(this)">
                            <option value="" disabled selected>Selecciona un producto</option>
                            <?php
                            $sqlProductos = "SELECT IdProducto, Nombre, PrecioUnitario FROM producto";
                            $rsProductos = mysqli_query($obj->getConexion(), $sqlProductos);
                            while ($producto = mysqli_fetch_array($rsProductos)) {
                                echo "<option value='" . $producto['IdProducto'] . "' data-precio='" . $producto['PrecioUnitario'] . "'>" . $producto['Nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="detalle-Cantidad">Cantidad</label>
                        <input type="number" name="Cantidad[]" class="form-control" required oninput="updateTotal(this)">
                    </div>
                    <div class="col-md-2">
                        <label for="detalle-PrecioUnitario">Costo Unitario</label>
                        <input type="number" step="0.01" name="PrecioUnitario[]" class="form-control" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="detalle-Descuento">Descuento (%)</label>
                        <input type="number" step="0.01" name="Descuento[]" class="form-control" oninput="updateTotal(this)">
                    </div>
                    <div class="col-md-2">
                        <label for="detalle-Total">Total</label>
                        <input type="number" step="0.01" name="Total[]" class="form-control" readonly>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm mt-4" onclick="removeDetalle(this)">Eliminar</button>
                    </div>
                </div>
            </div>
        `;
    }

    function addDetalle() {
        var detallePedidoContainer = document.querySelector(".detalle-pedido-container");
        var detalle = document.createElement("div");
        detalle.classList.add("detalle-pedido", "mb-3");
        detalle.innerHTML = `
            <div class="row">
                <div class="col-md-3">
                    <label for="detalle-IdProducto">Producto</label>
                    <select id="detalle-IdProducto" name="IdProducto[]" class="form-control" onchange="updatePrecioUnitario(this)">
                        <option value="" disabled selected>Selecciona un producto</option>
                        <?php
                        $sqlProductos = "SELECT IdProducto, Nombre, PrecioUnitario FROM producto";
                        $rsProductos = mysqli_query($obj->getConexion(), $sqlProductos);
                        while ($producto = mysqli_fetch_array($rsProductos)) {
                            echo "<option value='" . $producto['IdProducto'] . "' data-precio='" . $producto['PrecioUnitario'] . "'>" . $producto['Nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="detalle-Cantidad">Cantidad</label>
                    <input type="number" name="Cantidad[]" class="form-control" required oninput="updateTotal(this)">
                </div>
                <div class="col-md-2">
                    <label for="detalle-PrecioUnitario">Costo Unitario</label>
                    <input type="number" step="0.01" name="PrecioUnitario[]" class="form-control" readonly>
                </div>
                <div class="col-md-2">
                    <label for="detalle-Descuento">Descuento (%)</label>
                    <input type="number" step="0.01" name="Descuento[]" class="form-control" oninput="updateTotal(this)">
                </div>
                <div class="col-md-2">
                    <label for="detalle-Total">Total</label>
                    <input type="number" step="0.01" name="Total[]" class="form-control" readonly>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm mt-4" onclick="removeDetalle(this)">Eliminar</button>
                </div>
            </div>
        `;
        detallePedidoContainer.appendChild(detalle);
    }

    function removeDetalle(button) {
        var detalle = button.closest(".detalle-pedido");
        detalle.remove();
    }
</script>

</body>
</html>