<?php
require_once(__DIR__ . "/../coneccion/conector.php");

$obj = new Conectar();
$conexion = $obj->getConexion();

$IdProducto = $_POST['IdProducto'];
$Talla = $_POST['Talla'];
$Stock = $_POST['Stock'];

$sql_verificar = "SELECT Stock FROM producto_variantes WHERE IdProducto = ? AND Talla = ?";
$stmt_verificar = $conexion->prepare($sql_verificar);
$stmt_verificar->bind_param("is", $IdProducto, $Talla);
$stmt_verificar->execute();
$resultado_verificar = $stmt_verificar->get_result();

if ($resultado_verificar->num_rows > 0) {
    $fila = $resultado_verificar->fetch_assoc();
    $stock_actual = $fila['Stock'];
    $nuevo_stock = $stock_actual + $Stock;

    $sql_actualizar = "UPDATE producto_variantes SET Stock = ? WHERE IdProducto = ? AND Talla = ?";
    $stmt_actualizar = $conexion->prepare($sql_actualizar);
    $stmt_actualizar->bind_param("iis", $nuevo_stock, $IdProducto, $Talla);

    if ($stmt_actualizar->execute()) {
        header("Location: Productos_variantes.php");
        exit();
    } else {
        header("Location: Productos_variantes.php");
        exit();
    }
} else {
    $sql_insertar = "INSERT INTO producto_variantes (IdProducto, Talla, Stock) VALUES (?, ?, ?)";
    $stmt_insertar = $conexion->prepare($sql_insertar);
    $stmt_insertar->bind_param("isi", $IdProducto, $Talla, $Stock);

    if ($stmt_insertar->execute()) {
        header("Location: Productos_variantes.php");
        exit();
    } else {
        header("Location: Productos_variantes.php");
        exit();
    }
}
?>
