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

$sql = "SELECT id_evento, id_cliente, nombre_evento, fecha_evento, numero_invitados, mesas, sillas, color_forro FROM eventos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Lista de clientes</h2>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>ID DEL EVENTO</th>
            <th>ID DEL CLIENTE</th>
            <th>NOMBRE DEL EVENTO</th>
            <th>FECHA</th>
            <th>TOTAL DE INVITADOS</th>
            <th>MESAS</th>
            <th>SILLAS</th>
            <th>COLOR DE FORRO</th>
            <th>ACCION</th>
          </tr>";

          while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row['id_cliente']}</td>
        <td>{$row['id_evento']}</td>
        <td>{$row['nombre_evento']}</td>
        <td>{$row['fecha_evento']}</td>
        <td>{$row['numero_invitados']}</td>
        <td>{$row['mesas']}</td>
        <td>{$row['sillas']}</td>
        <td>{$row['color_forro']}</td>
        <td>
           <form action='editar_evento.php' method='get' style='display:inline-block;'>
    <input type='hidden' name='id' value='{$row['id_evento']}'>
    <button type='submit'>Modificar</button>
</form>
            <form action='evento.php' method='post' style='display:inline-block;' onsubmit=\"return confirm('¿Estás seguro de eliminar esta bebida?');\">
    <input type='hidden' name='id' value='{$row['id_evento']}'>
    <button type='submit'>Eliminar</button>
</form>

        </td>
      </tr>";

    }
    echo "</table>";
} else {
    echo "No hay bebidas eventos modificados.";
}

echo "<br><br><button onclick=\"window.location.href='additem.php'\" style=\"padding: 10px 20px;\">Agregar nuevo evento</button>";