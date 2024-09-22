<?php
require_once(__DIR__ . "/../../Admin/PHP/coneccion/conector.php");

session_start();
if (!isset($_SESSION['IdUsuario'])) {
    header("Location: ../PHP/login2.php");
    exit();
}

$IdUsuario = $_SESSION['IdUsuario'];

$obj = new Conectar();
$conexion = $obj->getConexion();

$sql = "SELECT cliente.*, usuario.NombreUsuario, usuario.CorreoElectronico, usuario.Contrasena 
        FROM cliente 
        INNER JOIN usuario ON cliente.IdUsuario = usuario.IdUsuario 
        WHERE cliente.IdUsuario = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $IdUsuario);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($resultado);

mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
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
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .MarcodeCaja {
            border-color: black;
            border-width: 5px;
            border-style: dashed;
            flex: 1;
            padding: 20px;
            max-width: 1200px;
            padding-bottom: 100px;
        }

        .page-title {
            color: #343a40;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
        }

        .profile-img {
            border-radius: 50%;
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .form-control {
            border: none;
            border-bottom: 1px solid #ced4da;
            background-color: #f9f9f9;
            padding: 12px;
            width: 100%;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-bottom-color: #0dcaf0;
            background-color: #ffffff;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 15px;
        }

        .form-horizontal .row {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .form-horizontal label {
            flex: 0 0 25%;
            max-width: 25%;
            padding-right: 20px;
            text-align: right;
            font-weight: bold;
            color: #343a40;
        }

        .form-horizontal .col-md-9 {
            flex: 0 0 75%;
            max-width: 75%;
        }

        .container-fluid {
            max-width: 1200px;
            margin: 0 auto;
        }

        #editButton {
            background-color: #0dcaf0;
            border: none;
            padding: 10px 20px;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        #editButton:hover {
            background-color: #0bb4cc;
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
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
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

    <!-- Cuerpo -->
    <div class="MarcodeCaja">
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Mi Perfil</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-xlg-3">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30">
                                    <!-- Imagen fija, no editable -->
                                    <img src="../ImagenQuienesSomos/imagen3.jpg" class="img-circle profile-img"
                                        width="130" />
                                    <h4 class="card-subtitle mt-2">Cliente</h4>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xlg-9">
                        <div class="card">
                            <div class="card-body">
                                <?php if ($row) { ?>
                                <form class="form-horizontal form-material mx-2" id="profileForm" action="guardar_perfil.php" method="POST">
                                    <!-- Campos que se pueden editar -->
                                    <div class="row mb-3">
                                        <label for="editNombreUsuario" class="col-md-3 col-form-label">Nombre
                                            Usuario:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="editNombreUsuario"
                                                name="NombreUsuario" value="<?php echo $row['NombreUsuario']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="editCorreoElectronico" class="col-md-3 col-form-label">Correo
                                            Electrónico:</label>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control" id="editCorreoElectronico"
                                                name="CorreoElectronico"
                                                value="<?php echo $row['CorreoElectronico']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="editContrasena" class="col-md-3 col-form-label">Contraseña:</label>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control" id="editContrasena"
                                                name="Contrasena" value="<?php echo $row['Contrasena']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="editNombre" class="col-md-3 col-form-label">Nombre:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="editNombre" name="Nombre"
                                                value="<?php echo $row['Nombre']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="editApellido" class="col-md-3 col-form-label">Apellido:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="editApellido" name="Apellido"
                                                value="<?php echo $row['Apellido']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="editSexo" class="col-md-3 col-form-label">Sexo:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="editSexo" name="Sexo"
                                                value="<?php echo $row['Sexo']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="editFechaNacimiento" class="col-md-3 col-form-label">Fecha de
                                            Nacimiento:</label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" id="editFechaNacimiento"
                                                name="FechaNacimiento" value="<?php echo $row['FechaNacimiento']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="editTelefono" class="col-md-3 col-form-label">Teléfono:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="editTelefono" name="Telefono"
                                                value="<?php echo $row['Telefono']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="editDni" class="col-md-3 col-form-label">DNI:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="editDni" name="Dni"
                                                value="<?php echo $row['Dni']; ?>" readonly>
                                        </div>
                                    </div>
                                    <!-- Botón de editar -->
                                    <button type="button" id="editButton">Editar Datos</button>
                                </form>
                                <?php } else { ?>
                                <div class="alert alert-danger" role="alert">
                                    No se encontraron datos del usuario.
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie de página -->
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
              <input type="text" class="form-control" placeholder="Ingresa tu correo.." aria-label="Ingresa tu correo.." aria-describedby="basic-addon2" />
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

<script>
document.getElementById('editButton').addEventListener('click', function () {
    let inputs = document.querySelectorAll('#profileForm input');
    let isEditable = inputs[0].readOnly; // Verificar si los campos están en modo de solo lectura

    inputs.forEach(input => {
        input.readOnly = !input.readOnly; // Alternar entre solo lectura y edición
    });

    // Cambiar el texto del botón
    this.textContent = isEditable ? 'Guardar Cambios' : 'Editar Datos';

    // Si estamos en modo de guardar, enviar el formulario
    if (!isEditable) {
        document.getElementById('profileForm').submit();
    }
});
</script>

</body>
</html>
