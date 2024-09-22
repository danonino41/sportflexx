<?php
// Iniciar sesión
session_start();

// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'sportflexx');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$producto = null;
$variantes = [];

if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];
    
    // Consulta para obtener los detalles del producto
    $sql = "SELECT p.Nombre, p.Descripcion, p.PrecioUnitario, p.ImagenProducto 
            FROM producto p 
            WHERE p.IdProducto = ?";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('i', $producto_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();
        
        // Consulta para obtener las variantes del producto (si tiene tallas)
        $sql_variantes = "SELECT Talla, Stock FROM producto_variantes WHERE IdProducto = ?";
        $stmt_variantes = $conexion->prepare($sql_variantes);
        $stmt_variantes->bind_param('i', $producto_id);
        $stmt_variantes->execute();
        $resultado_variantes = $stmt_variantes->get_result();
        
        while ($row = $resultado_variantes->fetch_assoc()) {
            $variantes[] = $row;
        }
    } else {
        echo "No se encontró el producto.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalles del Producto</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../EstilosMenus/EstilosMenu.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js" />
  <style>
    body {
        font-family: Arial, sans-serif;
    }
    .container {
        margin-top: 50px;
        margin-bottom: 50px;
    }
    .product-img {
        max-width: 100%;
        border-radius: 10px;
    }
    .product-details h3 {
        font-size: 24px;
        font-weight: bold;
    }
    .product-details p {
        font-size: 16px;
    }
    .price {
        font-size: 28px;
        font-weight: bold;
        color: #333;
    }
    .tallas input[type="radio"] {
        display: none;
    }
    .tallas label {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
    }
    .tallas input[type="radio"]:checked + label {
        background-color: #000;
        color: #fff;
        border-color: #000;
    }
    .btn-primary {
        background-color: #000;
        border-color: #000;
    }
    .guarantee {
        margin-top: 15px;
    }
    .shipping {
        margin-top: 10px;
    }
    .accordion-item {
        margin-top: 10px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a href="MenuPrincipalCliente.php" class="navbar-brand text-info fw-semibold fs-4">SPORTFLEXX</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral">
            <span class="navbar-toggler-icon"></span>
        </button>
        <section class="offcanvas offcanvas-start" id="menuLateral" tabindex="-1">
            <div class="offcanvas-header">
                <h1 class="canvas-title text-info TituiloMenu ms-5">SPORTFLEXX</h1>
                <button class="btn-close" type="button" aria-label="close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column justify-content-between px-0 Presentacion">
                <ul class="navbar-nav my-2 justify-content-evenly">
                    <li class="nav-item p-3 py-md-1">
                        <a href="hombreCliente.php" class="nav-link">HOMBRE</a>
                    </li>
                    <li class="nav-item p-3 py-md-1">
                        <a href="mujerCliente.php" class="nav-link">MUJER</a>
                    </li>
                    <li class="nav-item p-3 py-md-1">
                        <a href="accesoriosCliente.php" class="nav-link">ACCESORIOS</a>
                    </li>
                    <li class="nav-item p-3 py-md-1">
                        <a href="novedades.php" class="nav-link">NOVEDADES</a>
                    </li>
                    <li class="nav-item p-3 py-md-1">
                        <a href="carritoCliente.html" class="nav-link"><i class="bi bi-cart"></i></a>
                    </li>
                    <li class="nav-item dropdown p-3 py-md-1">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="MiPerfil.php"><i class="fas fa-cog"></i> Perfil</a>
                            <a class="dropdown-item" href="Logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                        </ul>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</nav>

<div class="container">
    <div class="row">
        <!-- Imagen del Producto -->
        <div class="col-md-6">
            <?php if ($producto): ?>
                <img src="http://localhost/SPORTFLEXX/Cliente/ImagenProductos/<?php echo $producto['ImagenProducto']; ?>" class="img-fluid product-img" alt="<?php echo $producto['Nombre']; ?>">
            <?php else: ?>
                <p>No hay imagen disponible</p>
            <?php endif; ?>
        </div>
        
        <!-- Detalles del Producto -->
        <div class="col-md-6 product-details">
            <?php if ($producto): ?>
                <h3><?php echo $producto['Nombre']; ?></h3>
                <p class="price">S/ <?php echo $producto['PrecioUnitario']; ?></p>

                <!-- Selección de Talla (solo si hay variantes con tallas) -->
                <?php if (!empty($variantes)): ?>
                    <div class="tallas">
                        <h5>TALLA</h5>
                        <?php foreach ($variantes as $variante): ?>
                            <input type="radio" name="talla" id="talla-<?php echo $variante['Talla']; ?>" value="<?php echo $variante['Talla']; ?>" required>
                            <label for="talla-<?php echo $variante['Talla']; ?>"><?php echo $variante['Talla']; ?></label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Botón de añadir al carrito -->
                <form method="POST" action="agregar_carrito.php">
                    <button type="submit" class="btn btn-primary btn-lg mt-4 w-100">AÑADIR AL CARRITO</button>
                </form>

                <!-- Garantía -->
                <div class="guarantee">
                    <i class="fas fa-check-circle"></i> 10 días de garantía.
                </div>

                <!-- Envío -->
                <div class="shipping">
                    <i class="fas fa-shipping-fast"></i> Envío gratis al comprar 2 o más productos.
                </div>

                <!-- Acordeón para detalles adicionales -->
                <div class="accordion" id="productDetailsAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                Descripción
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <?php echo $producto['Descripcion']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                Tiempo de entrega
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                El tiempo de entrega estimado es de 2-3 días hábiles.
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p>No se encontró el producto.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-sm-6">
          <div class="single-box">
            <h2>AYUDA</h2>
            <ul>
              <li><a href="preguntasFrecuentes.html">Preguntas frecuentes</a></li>
              <li><a href="informacionEntrega.html">Informacion de entrega</a></li>
              <li><a href="politicaDevolucion.html">Politica de devolucion</a></li>
              <li><a href="HacerDevolucion.html">Hacer una devolucion</a></li>
              <li><a href="pedidos.html">Pedidios</a></li> 
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6"> 
          <div class="single-box">
            <h2>PAGINAS</h2>
            <ul>
              <li><a href="QuienesSomos.html">Quienes somos</a></li>
              <li><a href="declaracionAccesibilidad.html">Declaracion de accesibilidad</a></li>
              <li><a href="#">Sostenibilidad</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="single-box">
            <h3>UNETE A LA FAMILIA SPORTFLEXX</h3>
            <p>
              Reciba actualizaciones al instante, acceda a ofertas exclusivas,
              detalles de lanzamiento de productos y mas.
            </p>
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Ingresa tu correo.." aria-label="Enter your Email ..." aria-describedby="basic-addon2" />
              <span class="input-group-text" id="basic-addon2"><i class="fa fa-long-arrow-right"></i></span>
            </div>
            <h2>Síguenos en</h2>
            <p class="socials">
              <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
              <a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
              <a href="https://www.pinterest.com/"><i class="fa fa-pinterest"></i></a>
              <a href="https://twitter.com/"><i class="fa fa-twitter"></i></a>
            </p>
            <div class="card-area">
              <i class="fa fa-cc-visa"></i>
              <i class="fa fa-credit-card"></i>
              <i class="fa fa-cc-mastercard"></i>
              <i class="fa fa-cc-paypal"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
