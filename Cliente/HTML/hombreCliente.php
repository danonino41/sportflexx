<?php
session_start();
include_once "navbar.php"; //es el nav
require_once(__DIR__ . "/../../Admin/PHP/coneccion/conector.php");
$obj = new Conectar();
$conexion = $obj->getConexion();

function mostrarProductosHombre($conexion) {
    $query = "SELECT * FROM producto WHERE IdCategoria = 1"; // Categoría 1 para "Hombres"
    $stmt = $conexion->prepare($query);
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
                    <img src="' . $imagenRuta . '" class="card-img-top" alt="Imagen de ' . htmlspecialchars($row['Nombre']) . '">
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hombre</title>
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
<div class="container mt-5">
    <h3 class="text-left my-2">HOMBRE</h3>
    <div class="row row-cols-1 row-cols-md-4 g-4 py-5">
        <?php mostrarProductosHombre($conexion); ?>
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
