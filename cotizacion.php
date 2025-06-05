<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Cotización</title>
    <link rel='stylesheet' href='stylecotizacion.css'>
</head>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_eventos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

echo "<h2>Seleccione sus productos</h2>";
echo "<form action='recibo.php' method='post'>";

$sql = "SELECT id_bebida, nombre, descripcion, precio FROM bebidas";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<h3>Bebidas</h3>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>Seleccionar</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
          </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td><input type='checkbox' name='bebidas[]' value='{$row['id_bebida']}'></td>
                <td>{$row['nombre']}</td>
                <td>{$row['descripcion']}</td>
                <td>\${$row['precio']}</td>
                <td><input type='number' name='cantidad_bebida[{$row['id_bebida']}]' min='1' max='100' style='width:60px;'></td>
              </tr>";
    }
    echo "</table>";
}
$sql_platillos = "SELECT id_platillo, nombre, descripcion, precio FROM platillos";
$result_platillos = $conn->query($sql_platillos);
if ($result_platillos->num_rows > 0) {
    echo "<h3>Platillos</h3>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>Seleccionar</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
          </tr>";
    while($row = $result_platillos->fetch_assoc()) {
        echo "<tr>
                <td><input type='checkbox' name='platillos[]' value='{$row['id_platillo']}'></td>
                <td>{$row['nombre']}</td>
                <td>{$row['descripcion']}</td>
                <td>\${$row['precio']}</td>
                <td><input type='number' name='cantidad_platillo[{$row['id_platillo']}]' min='1' max='100' style='width:60px;'></td>
              </tr>";
    }
    echo "</table>";
}

$sql_postres = "SELECT id_postre, nombre, descripcion, precio FROM postres";
$result_postre = $conn->query($sql_postres);
if ($result_postre->num_rows > 0) {
    echo "<h3>Postres</h3>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>Seleccionar</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
          </tr>";
    while($row = $result_postre->fetch_assoc()) {
        echo "<tr>
                <td><input type='checkbox' name='postres[]' value='{$row['id_postre']}'></td>
                <td>{$row['nombre']}</td>
                <td>{$row['descripcion']}</td>
                <td>\${$row['precio']}</td>
                <td><input type='number' name='cantidad_postre[{$row['id_postre']}]' min='1' max='100' style='width:60px;'></td>
              </tr>";
    }
    echo "</table>";
}

echo "<br><button type='submit'>Agregar al carrito</button>";
echo "</form>";

$conn->close();
?>
