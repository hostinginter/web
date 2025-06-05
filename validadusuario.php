<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "bd_eventos";

$conexion = new mysqli($host, $usuario, $contrasena, $bd);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono']; // antes estaba mal

$sql = "SELECT * FROM clientes WHERE nombre = ? AND telefono = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ss", $nombre, $telefono);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    $rol = $usuario['rol'];

    if ($rol === 'cliente') {
        header("Location: index.html");
    } elseif ($rol === 'empleado') {
        header("Location: quotes.html");
    } elseif ($rol === 'administrador') {
        header("Location: quotes.html");
    }
    exit();
} else {
    echo "<script>
        alert('Credenciales incorrectas');
        window.location.href = 'login.html';
    </script>";
}
?>

