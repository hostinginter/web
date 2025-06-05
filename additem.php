<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Bebida</title>
    <link rel="stylesheet" href="styleadditem.css">
</head>
<body>
    <div class="form-container">
        <h2>Agregar Nueva Bebida</h2>
        <form method="post" action="additem.php">
            <label>Nombre:</label><br>
            <input type="text" name="nombre" required><br>

            <label>Descripción:</label><br>
            <textarea name="descripcion" required></textarea><br>

            <label>Precio:</label><br>
            <input type="number" step="0.01" name="precio" required><br>

            <button type="submit">Guardar Bebida</button>
            <button type="button" class="cancel-button" onclick="window.location.href='conexion.php'">Cancelar</button>
        </form>
    </div>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_eventos";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = floatval($_POST["precio"]);

    $sql = "INSERT INTO bebidas (nombre, descripcion, precio) VALUES ('$nombre', '$descripcion', $precio)";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: conexion.php");
        exit();
    } else {
        echo "Error al guardar: " . $conn->error;
    }
}
?>


