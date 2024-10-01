<?php
require_once(__DIR__ . "/../coneccion/conector.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obj = new Conectar();
    $IdProducto = $_POST["IdProducto"];
    $Nombre = $_POST["Nombre"];
    $Descripcion = $_POST["Descripcion"];
    $IdCategoria = $_POST["IdCategoria"];
    $PrecioUnitario = $_POST["PrecioUnitario"];
    $FechaRegistro = $_POST["FechaRegistro"];
    $Genero = $_POST["Genero"];
    $Talla = $_POST["Talla"];
    $Color = $_POST["Color"];
    $Stock = $_POST["Stock"];

    $sqlCheck = "SELECT COUNT(*) as count FROM producto WHERE Nombre = ?";
    $stmtCheck = $obj->getConexion()->prepare($sqlCheck);
    $stmtCheck->bind_param("s", $Nombre);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();
    $row = $resultCheck->fetch_assoc();

    if ($row['count'] > 0) {
        $contador = 1;
        $nuevoNombre = $Nombre . " (" . $contador . ")";
        while (true) {
            $sqlCheckNombre = "SELECT COUNT(*) as count FROM producto WHERE Nombre = ?";
            $stmtCheckNombre = $obj->getConexion()->prepare($sqlCheckNombre);
            $stmtCheckNombre->bind_param("s", $nuevoNombre);
            $stmtCheckNombre->execute();
            $resultCheckNombre = $stmtCheckNombre->get_result();
            $rowCheckNombre = $resultCheckNombre->fetch_assoc();

            if ($rowCheckNombre['count'] == 0) {
                $Nombre = $nuevoNombre; 
                break;
            } else {
                $contador++;
                $nuevoNombre = $Nombre . " (" . $contador . ")";
            }
        }
    }

    if (isset($_FILES['ImagenProducto']) && $_FILES['ImagenProducto']['error'] == 0) {
        $target_dir = "C:/xampp/htdocs/sportflexx/Cliente/ImagenProductos/";
        $imageFileType = strtolower(pathinfo($_FILES["ImagenProducto"]["name"], PATHINFO_EXTENSION));
        $uniqueImageName = uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $uniqueImageName;
        if (move_uploaded_file($_FILES["ImagenProducto"]["tmp_name"], $target_file)) {
            $ImagenProducto = $uniqueImageName;
        }
    }
    

    if ($IdProducto == 0) {
        $sqlProducto = "INSERT INTO producto (Nombre, Descripcion, IdCategoria, PrecioUnitario, FechaRegistro, Genero, ImagenProducto) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtProducto = $obj->getConexion()->prepare($sqlProducto);
        $stmtProducto->bind_param("ssidsis", $Nombre, $Descripcion, $IdCategoria, $PrecioUnitario, $FechaRegistro, $Genero, $ImagenProducto);
        $stmtProducto->execute();
        $IdProducto = $obj->getConexion()->insert_id;

        $sqlVariante = "INSERT INTO producto_variantes (IdProducto, Talla, Color, Stock) VALUES (?, ?, ?, ?)";
        $stmtVariante = $obj->getConexion()->prepare($sqlVariante);
        $stmtVariante->bind_param("issi", $IdProducto, $Talla, $Color, $Stock);
        $stmtVariante->execute();
    } else {
        $sqlProducto = "UPDATE producto SET Nombre = ?, Descripcion = ?, IdCategoria = ?, PrecioUnitario = ?, FechaRegistro = ?, Genero = ?, ImagenProducto = ? WHERE IdProducto = ?";
        $stmtProducto = $obj->getConexion()->prepare($sqlProducto);
        $stmtProducto->bind_param("ssidsisi", $Nombre, $Descripcion, $IdCategoria, $PrecioUnitario, $FechaRegistro, $Genero, $ImagenProducto, $IdProducto);
        $stmtProducto->execute();

        $sqlVariante = "UPDATE producto_variantes SET Talla = ?, Color = ?, Stock = ? WHERE IdProducto = ?";
        $stmtVariante = $obj->getConexion()->prepare($sqlVariante);
        $stmtVariante->bind_param("ssii", $Talla, $Color, $Stock, $IdProducto);
        $stmtVariante->execute();
    }

    header("Location: Productos.php");
    exit();
}
?>
