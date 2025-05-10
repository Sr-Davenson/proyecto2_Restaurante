<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Orden.php';
include '../../controller/controllerOrden.php';

$fecha = date('Y-m-d H:i:s', strtotime($_POST['fecha']));
$idTable = intval($_POST['idTable']);
$platosSeleccionados = $_POST['idPlato'] ?? [];
$totalOrden = 0;

$conexDb = new mysqli("localhost", "root", "", "proyecto_2_db");

// Insertar la orden en `orders`
$sqlOrden = "INSERT INTO orders (dateOrder, total, idTable) VALUES ('$fecha', 0, $idTable)";
$conexDb->query($sqlOrden);

// Obtener el ID de la orden recién creada
$orderID = $conexDb->insert_id;

// Insertar detalles de la orden en `order_details`
foreach ($platosSeleccionados as $idPlato) {
    $cantidad = intval($_POST['cantidad'][$idPlato]);

    // Obtener precio del plato desde la base de datos
    $sqlPrecio = "SELECT price FROM dishes WHERE id = $idPlato";
    $result = $conexDb->query($sqlPrecio);
    $row = $result->fetch_assoc();
    $precioUnitario = $row['price'];

    // Calcular subtotal
    $subtotal = $cantidad * $precioUnitario;

    // Insertar detalle en `order_details`
    $sqlDetalle = "INSERT INTO order_details (idOrder, idDish, quantity, price) VALUES ($orderID, $idPlato, $cantidad, $precioUnitario)";
    $conexDb->query($sqlDetalle);

    // Acumular total
    $totalOrden += $subtotal;
}

// Actualizar el total de la orden
$conexDb->query("UPDATE orders SET total = $totalOrden WHERE id = $orderID");

echo "<p class='msg-ok'>Orden creada con ID: $orderID</p>";
echo '    <a href="../inicio.php">Ir a inicio</a>';


$conexDb->close();