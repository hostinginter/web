<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_eventos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$total = 0;
echo "<h2>Recibo de pedido</h2>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Producto</th><th>Precio Unitario</th><th>Cantidad</th><th>Subtotal</th></tr>";


function procesar_categoria($conn, $tabla, $campo_id, $productos, $cantidades) {
    global $total;
    if (!empty($productos)) {
        foreach ($productos as $id) {
            $id = intval($id);
            $cantidad = isset($cantidades[$id]) ? intval($cantidades[$id]) : 0;
            if ($cantidad > 0) {
                $sql = "SELECT nombre, precio FROM $tabla WHERE $campo_id = $id";
                $res = $conn->query($sql);
                if ($res && $res->num_rows > 0) {
                    $row = $res->fetch_assoc();
                    $subtotal = $row['precio'] * $cantidad;
                    $total += $subtotal;
                    echo "<tr>
                            <td>{$row['nombre']}</td>
                            <td>\${$row['precio']}</td>
                            <td>$cantidad</td>
                            <td>\$$subtotal</td>
                          </tr>";
                }
            }
        }
    }
}


procesar_categoria($conn, "bebidas", "id_bebida", $_POST['bebidas'] ?? [], $_POST['cantidad_bebida'] ?? []);


procesar_categoria($conn, "platillos", "id_platillo", $_POST['platillos'] ?? [], $_POST['cantidad_platillo'] ?? []);


procesar_categoria($conn, "postres", "id_postre", $_POST['postres'] ?? [], $_POST['cantidad_postre'] ?? []);

echo "<tr><td colspan='3' style='text-align:right'><strong>Total a pagar:</strong></td><td><strong>\$$total</strong></td></tr>";
echo "</table>";

$conn->close();

echo "<br><a href='index.html'>Volver a la selección</a>";
?>
