<?php
require_once(__DIR__ . "/../coneccion/conector.php");

if (isset($_POST['btnRegistrar'])) {
    // Aquí eliminamos los campos que ya no existen
    $requiredFields = [
        'NombreUsuario', 'CorreoElectronico', 'Contrasena' // Mantener solo los campos existentes
    ];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            echo "Por favor, complete todos los campos.";
            exit();
        }
    }

    // Recoger datos del formulario
    $nombreUsuario = $_POST['NombreUsuario'];
    $correoElectronico = $_POST['CorreoElectronico'];
    $contrasena = $_POST['Contrasena'];  // Sin hash, en texto plano

    $obj = new Conectar();
    $conexion = $obj->getConexion();

    // Iniciar la transacción
    $conexion->begin_transaction();

    try {
        // Insertar en la tabla usuario (ajustar columnas según la estructura actual)
        $stmt = $conexion->prepare("INSERT INTO usuario (NombreUsuario, CorreoElectronico, Contrasena, IdRol) VALUES (?, ?, ?, 2)");
        $stmt->bind_param("sss", $nombreUsuario, $correoElectronico, $contrasena);
        if (!$stmt->execute()) {
            throw new Exception("Error al insertar en la tabla usuario: " . $stmt->error);
        }
        $stmt->close();

        // Confirmar la transacción
        $conexion->commit();

        // Redirigir a la página de login después del registro exitoso
        header("Location: login2.php");
        exit();

    } catch (Exception $e) {
        // En caso de error, deshacer la transacción
        $conexion->rollback();
        echo "Error: " . $e->getMessage();
    }

    $conexion->close();
}
?>
