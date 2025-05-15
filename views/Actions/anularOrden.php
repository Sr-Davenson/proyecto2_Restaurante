<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Orden.php';
include '../../models/entities/Mesas.php';
include '../../models/entities/Plato.php';
include '../../models/entities/DetalleOrden.php';
include '../../controller/controllerPlatos.php';
include '../../controller/controllerMesas.php';
include '../../controller/controllerOrden.php';
include '../../controller/controllerDetalleOrden.php';


use App\controllers\controllerOrden;

$controllerOrden = new controllerOrden();
$id = $_POST['idOrden'];
if ($id == null) {
    header("Location: ../Forms/formOrdenAnulada.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../images/log.ico">
    <link rel="stylesheet" href="../../CSS/styleResulOp.css">
    <title>Resultado operación</title>
</head>

<body>
    <h1>Resultado de la operación</h1>
    <?php
    $res = $controllerOrden->anular($id);
    if ($res == 'yes') {
        echo '<p class="msg-ok">Orden Anulada</p>';
        echo '';
    } else {
        echo  '<p class="msg-error">No se pudo anular la orden/p>';
    }
    ?>
    <br>
    <a class="botones" href="../inicio.php">Ir a inicio</a>
</body>

</html>