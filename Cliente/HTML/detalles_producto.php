<?php
session_start();

$conexion = new mysqli('localhost', 'root', '', 'sportflexx');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$producto = null;
$variantes = [];

if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];
    
    $sql = "SELECT p.Nombre, p.Descripcion, p.PrecioUnitario, p.ImagenProducto 
            FROM producto p 
            WHERE p.IdProducto = ?";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('i', $producto_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();
        
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

<?php include_once "navbar.php"; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <?php if ($producto): ?>
                <img src="http://localhost/SPORTFLEXX/Cliente/ImagenProductos/<?php echo $producto['ImagenProducto']; ?>" class="img-fluid product-img" alt="<?php echo $producto['Nombre']; ?>">
            <?php else: ?>
                <p>No hay imagen disponible</p>
            <?php endif; ?>
        </div>
        
        <div class="col-md-6 product-details">
            <?php if ($producto): ?>
                <h3><?php echo $producto['Nombre']; ?></h3>
                <p class="price">S/ <?php echo $producto['PrecioUnitario']; ?></p>

                <?php if (!empty($variantes)): ?>
                    <div class="tallas">
                        <h5>TALLA</h5>
                        <?php foreach ($variantes as $variante): ?>
                            <input type="radio" name="talla" id="talla-<?php echo $variante['Talla']; ?>" value="<?php echo $variante['Talla']; ?>" required>
                            <label for="talla-<?php echo $variante['Talla']; ?>"><?php echo $variante['Talla']; ?></label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="guarantee">
                    <i class="fas fa-check-circle"></i> 10 días de garantía.
                </div>

                <div class="shipping">
                    <i class="fas fa-shipping-fast"></i> Envío gratis al comprar 2 o más productos.
                </div>

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

<?php include_once "footer.php"; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
