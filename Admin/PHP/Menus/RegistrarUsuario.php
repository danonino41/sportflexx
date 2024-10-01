<?php
require_once(__DIR__ . "/../coneccion/conector.php");

if (isset($_POST['btnRegistrar'])) {
    // Validar que todos los campos requeridos estén presentes
    $requiredFields = [
        'NombreUsuario', 'CorreoElectronico', 'Contrasena', 'ConfirmarContrasena',
        'Nombre', 'Apellido', 'Sexo', 'FechaNacimiento', 'Telefono', 'Dni', 'Direccion'
    ];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $_SESSION['mensaje'] = "Por favor, complete todos los campos.";
            header("Location: ../../Cliente/PHP/login2.php");  // Redirige de vuelta al formulario de registro
            exit();
        }
    }

    // Recoger datos del formulario
    $nombreUsuario = $_POST['NombreUsuario'];
    $correoElectronico = $_POST['CorreoElectronico'];
    $contrasena = $_POST['Contrasena'];
    $confirmarContrasena = $_POST['ConfirmarContrasena'];

    // Datos adicionales del cliente
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $sexo = $_POST['Sexo'];
    $fechaNacimiento = $_POST['FechaNacimiento'];
    $telefono = $_POST['Telefono'];
    $dni = $_POST['Dni'];
    $direccion = $_POST['Direccion'];

    // Verificar que las contraseñas coincidan
    if ($contrasena !== $confirmarContrasena) {
        $_SESSION['mensaje'] = "Las contraseñas no coinciden.";
        header("Location: ../../Cliente/PHP/login2.php");
        exit();
    }

    // Hashear la contraseña para mayor seguridad
    $contrasenaHasheada = password_hash($contrasena, PASSWORD_DEFAULT);

    // Crear la conexión a la base de datos
    $obj = new Conectar();
    $conexion = $obj->getConexion();

    // Iniciar la transacción
    $conexion->begin_transaction();

    try {
        // Insertar en la tabla usuario
        $stmtUsuario = $conexion->prepare(
            "INSERT INTO usuario (NombreUsuario, CorreoElectronico, Contrasena, IdRol) VALUES (?, ?, ?, 2)"
        );
        $stmtUsuario->bind_param("sss", $nombreUsuario, $correoElectronico, $contrasenaHasheada);

        if (!$stmtUsuario->execute()) {
            throw new Exception("Error al insertar en la tabla usuario: " . $stmtUsuario->error);
        }

        // Obtener el ID del usuario recién insertado
        $idUsuario = $conexion->insert_id;
        $stmtUsuario->close();

        // Insertar en la tabla cliente
        $stmtCliente = $conexion->prepare(
            "INSERT INTO cliente (IdUsuario, Nombre, Apellido, Sexo, FechaNacimiento, Telefono, Dni, Direccion) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmtCliente->bind_param(
            "isssssis",
            $idUsuario, $nombre, $apellido, $sexo, $fechaNacimiento, $telefono, $dni, $direccion
        );

        if (!$stmtCliente->execute()) {
            throw new Exception("Error al insertar en la tabla cliente: " . $stmtCliente->error);
        }
        $stmtCliente->close();

        // Confirmar la transacción
        $conexion->commit();

        // Redirigir a la página de login después del registro exitoso
        $_SESSION['mensaje'] = "Registro exitoso. Inicie sesión.";
        header("Location: ../../Cliente/PHP/login2.php");
        exit();
    } catch (Exception $e) {
        // En caso de error, deshacer la transacción
        $conexion->rollback();
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
