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

isset($_POST['fecha']) ? $_POST['fecha'] : header("Location: ../crearOrden.php");
isset($_POST['idMesa']) ? $_POST['idMesa'] : header("Location: ../crearOrden.php");
if (isset($_POST['idPlato']) == null) {
    echo "<p class='msg-error'>Debe seleccionar al menos un plato</p>";
    echo '<a href="../CrearOrden.php">Volver</a>';
    exit();
}
$fecha = date('Y-m-d H:i:s', strtotime($_POST['fecha']));
$idMesa = intval($_POST['idMesa']);
$platosSeleccionados = $_POST['idPlato'];
$totalOrden = 0;
$estado = 0;
$idOrden = $controllerOrden->saveNewOrden($_POST, 0);
$totalOrden = $controllerDetalle->saveNewDetalleOrden($platosSeleccionados, $_POST['cantidad'], $idOrden);

$res = $controllerOrden->updateOrden($idOrden, $totalOrden, $estado);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../images/log.ico">
    <link rel="stylesheet" href="../../CSS/styleResulOp.css">
    <title>Crear Orden</title>
</head>

<body>
    <h1>Resultado de la operación</h1>
    <?php
    if ($res == 'yes') {
        echo "<p class='msg-ok'>Orden creada, preparando preparacion</p>";
        echo '<a class="botones" href="../inicio.php">Ir a inicio</a>';
    } else {
        echo "<p class='msg-error'>No se pudo registrar la orden</p>";
    }
    ?>
</body>

</html>