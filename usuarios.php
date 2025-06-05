<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Menú</title>
    <link rel='stylesheet' href='stylephp.css'>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_eventos";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id_cliente, nombre, correo, telefono, rol FROM clientes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Lista de clientes</h2>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>correo</th>
            <th>telefono</th>
            <th>rol</th>
            <th>accion</th>
          </tr>";

          while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row['id_cliente']}</td>
        <td>{$row['nombre']}</td>
        <td>{$row['correo']}</td>
        <td>{$row['telefono']}</td>
        <td>{$row['rol']}</td>
        <td>
           <form action='editar_cliente.php' method='get' style='display:inline-block;'>
    <input type='hidden' name='id' value='{$row['id_cliente']}'>
    <button type='submit'>Modificar</button>
</form>
            <form action='usuarios.php' method='post' style='display:inline-block;' onsubmit=\"return confirm('¿Estás seguro de eliminar esta bebida?');\">
    <input type='hidden' name='id' value='{$row['id_cliente']}'>
    <button type='submit'>Eliminar</button>
</form>

        </td>
      </tr>";

    }
    echo "</table>";
} else {
    echo "No hay bebidas registradas.";
}

echo "<br><br><button onclick=\"window.location.href='additem.php'\" style=\"padding: 10px 20px;\">Agregar nuevo usuario</button>";