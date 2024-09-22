<?php
session_start();
require_once(__DIR__ . "/../../Admin/PHP/coneccion/conector.php");
$obj = new Conectar();
$conexion = $obj->getConexion();

function mostrarProductos($categoriaId, $conexion) {
    $query = "SELECT * FROM producto WHERE IdCategoria = ? LIMIT 4";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $categoriaId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Definimos la ruta base centralizada para todas las imágenes
    $rutaBaseImagen = "../ImagenProductos/";

    while ($row = $result->fetch_assoc()) {
        // Asumimos que la imagen se guarda en la columna ImagenProducto
        $imagenRuta = $rutaBaseImagen . $row['ImagenProducto'];

        // Verificamos si la imagen existe
        if (!file_exists($imagenRuta)) {
            $imagenRuta = "../ImagenProductos/default.png"; // Imagen por defecto si no existe
        }

        // Limitar el nombre del producto a 50 caracteres máximo y añadir '...' si es más largo
        $nombreProducto = (strlen($row['Nombre']) > 50) ? substr($row['Nombre'], 0, 50) . '...' : $row['Nombre'];

        echo '<div class="col">
                <div class="card h-100">
                    <img src="' . $imagenRuta . '" class="card-img-top" alt="Imagen de ' . $row['Nombre'] . '">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title wbon">' . htmlspecialchars($nombreProducto) . '</h5>
                        <p class="precio">S/ ' . number_format($row['PrecioUnitario'], 2) . '</p>
                        <div class="mt-auto">
                            <a href="detalles_producto.php?id=' . $row['IdProducto'] . '" class="btn btn-primary w-100">Ver detalles</a>
                        </div>
                    </div>
                </div>
              </div>';
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SPORTFLEXX</title>
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
        .carousel-item img,
        .carousel-item video {
            width: 100%;
            height: 89vh;
            object-fit: cover;
        }
        .carousel-caption {
            bottom: 20%;
        }
        nav, .offcanvas {
            background-color: #1e293b;
        }
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: #1e293b;
            font-family: 'Roboto', sans-serif;
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .precio {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }
        .card-body {
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .wbon {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }
    </style>
</head>

<body>
  <!-- MENU START -->
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


  <!-- IMÁGENES -->
  <div class="container-fluid p-0">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <video class="video-fluid w-100" autoplay loop muted>
            <source src="../ImagenMenu/LOOK_5_-_Web_Banner_-_April_Key_Looks_-_16x9.mp4" type="video/mp4">
          </video>
          <div class="carousel-caption d-none d-md-block">
            <h2 class="text-warning fw-bold">Bienvenido a Sportflexx</h2>
            <button scr="novedades.php" type="button" class="btn btn-warning btn-lg mt-3 text-white">Novedades</button>
          </div>
        </div>
        <div class="carousel-item">
          <img src="../ImagenMenu/image.png" class="d-block w-100" alt="Nature with sea">
          <div class="carousel-caption d-none d-md-block">
            <h2 class="text-warning fw-bold">Bienvenido a Sportflexx</h2>
            <button scr="novedades.php" type="button" class="btn btn-warning btn-lg mt-3 text-white">Novedades</button>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>

  <!-- Productos -->
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h3 class="text-left my-2">HOMBRES</h3>
        <a href="hombreCliente.php"><h4 class="text-left">ver todo</h4></a>
      </div>
    </div>
    <div class="row row-cols-2 row-cols-md-4 g-4 py-5">
      <?php mostrarProductos(1, $conexion); ?>
    </div>

    <div class="row">
      <div class="col-12">
        <h3 class="text-left my-2">MUJERES</h3>
        <a href="mujerCliente.php"><h4 class="text-left">ver todo</h4></a>
      </div>
    </div>
    <div class="row row-cols-2 row-cols-md-4 g-4 py-5">
      <?php mostrarProductos(2, $conexion); ?>
    </div>

    <div class="row">
      <div class="col-12">
        <h3 class="text-left my-2">ACCESORIOS</h3>
        <a href="AccesoriosCliente.php"><h4 class="text-left">ver todo</h4></a>
      </div>
    </div>
    <div class="row row-cols-2 row-cols-md-4 g-4 py-5">
      <?php mostrarProductos(3, $conexion); ?>
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

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="carrito-common.js"></script>
  <script src="carritoCliente.js"></script>

</body>
</html>
