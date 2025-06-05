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
    die(" Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM bebidas WHERE id_bebida = $id";

    if ($conn->query($sql) === TRUE) {
       
        header("Location: conexion.php");
        exit();
    } else {
        echo "❌ Error al eliminar: " . $conn->error;
    }
}

$sql = "SELECT id_bebida, nombre, descripcion, precio FROM bebidas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Lista de Bebidas</h2>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>accion</th>
          </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row['id_bebida']}</td>
        <td>{$row['nombre']}</td>
        <td>{$row['descripcion']}</td>
        <td>\${$row['precio']}</td>
        <td>
           <form action='editar_bebida.php' method='get' style='display:inline-block;'>
    <input type='hidden' name='id' value='{$row['id_bebida']}'>
    <button type='submit'>Modificar</button>
</form>
            <form action='conexion.php' method='post' style='display:inline-block;' onsubmit=\"return confirm('¿Estás seguro de eliminar esta bebida?');\">
    <input type='hidden' name='id' value='{$row['id_bebida']}'>
    <button type='submit'>Eliminar</button>
</form>

        </td>
      </tr>";

    }

    echo "</table>";
} else {
    echo "No hay bebidas registradas.";
}

echo "<br><br><button onclick=\"window.location.href='additem.php'\" style=\"padding: 10px 20px;\">Agregar nuevo registro</button>";

echo "<h2> Lista de Platillos</h2>";

$sql_platillos = "SELECT id_platillo, nombre, descripcion, precio FROM platillos";
$result_platillos = $conn->query($sql_platillos);

if ($result_platillos->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
          </tr>";

    while($row = $result_platillos->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id_platillo']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['descripcion']}</td>
                <td>\${$row['precio']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay platillos registrados.";
}

$sql_postres = "SELECT id_postre, nombre, descripcion, precio FROM postres";
$result_postre = $conn->query($sql_postres);

echo "<h2>Menu de los Postres</h2>";

echo "<table border='1' cellpadding='10'>";
echo "<tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Precio</th>
    </tr>";

    while($row = $result_postre->fetch_assoc()){
        echo "<tr>
                <td>{$row['id_postre']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['descripcion']}</td>
                <td>{$row['precio']}</td>
        </tr>";
        }

echo "</table>";



$conn->close();

echo "<br><br><button onclick=\"window.location.href='quotes.html'\" style=\"padding: 10px 20px;\">Go Back</button>";

?>



</body>
</html>

