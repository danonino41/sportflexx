<?php
require_once(__DIR__ . "/../coneccion/conector.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obj = new Conectar();
    $IdVariante = $_POST["IdVariante"];
    $IdProducto = $_POST["IdProducto"];
    $Talla = $_POST["Talla"];
    $Stock = $_POST["Stock"];

    if ($IdVariante == 0) {
        $sqlVariante = "INSERT INTO producto_variantes (IdProducto, Talla, Stock) VALUES (?, ?, ?)";
        $stmtVariante = $obj->getConexion()->prepare($sqlVariante);
        $stmtVariante->bind_param("isi", $IdProducto, $Talla, $Stock);
        $stmtVariante->execute();
    } else {
        $sqlUpdateVariante = "UPDATE producto_variantes SET IdProducto = ?, Talla = ?, Stock = ? WHERE IdVariante = ?";
        $stmtUpdateVariante = $obj->getConexion()->prepare($sqlUpdateVariante);
        $stmtUpdateVariante->bind_param("isii", $IdProducto, $Talla, $Stock, $IdVariante);
        $stmtUpdateVariante->execute();
    }

    header("Location: Productos_variantes.php");
    exit();
}
?>
