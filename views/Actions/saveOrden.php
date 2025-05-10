<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Orden.php';
include '../../models/entities/DetalleOrden.php';
include '../../controller/controllerOrden.php';
include '../../controller/controllerDetalleOrden.php';

use App\controllers\controllerDetalleOrden;
use App\controllers\controllerOrden;

$controllerOrden = new controllerOrden();
$controllerDetalle = new controllerDetalleOrden();

$fecha = isset($_POST['fecha']) ? date('Y-m-d H:i:s', strtotime($_POST['fecha'])) : null;
$idMesa = isset($_POST['idMesa']) ? intval($_POST['idMesa']) : null;
if ($fecha == null || $idMesa == null) {
    header("Location: ../crearOrden.php");
}
$fecha = date('Y-m-d H:i:s', strtotime($_POST['fecha']));
$idMesa = intval($_POST['idMesa']);
$platosSeleccionados = $_POST['idPlato'] ?? [];
$totalOrden = 0;


$orderID = $controllerOrden->saveNewOrden($_POST, 0);


echo "ID de orden creada: " . $orderID;


$totalOrden = $controllerDetalle->saveNewDetalleOrden($platosSeleccionados, ['idOrden' => $orderID, 'cantidad' => $_POST['cantidad']]);




$res = $controllerOrden->updateOrden($orderID, $totalOrden);


if ($res == 'yes') {
    echo "<p class='msg-ok'>Orden creada con ID: $orderID</p>";
    echo '<a href="../inicio.php">Ir a inicio</a>';
} else {
    echo "<p class='msg-error'>No se pudo registrar la orden</p>";
}
