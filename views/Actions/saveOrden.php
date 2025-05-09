<?php
// include '../../models/connection/conexDB.php';
// include '../../models/util/model.php';
// include '../../models/entities/Orden.php';
// include '../../controller/controllerOrden.php';

// use App\controllers\controllerOrden;
// $controller = new controllerOrden();

// $total = $_POST['total'];
// $fecha = $_POST['fecha'];
// $res = $controller->procesarOrden($_POST);



include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Orden.php';
include '../../controller/controllerOrden.php';

use App\controllers\controllerOrden;
$controller = new controllerOrden();
var_dump($_POST); // Para ver qué datos llegan
$total = $_POST['total'];
$fecha = $_POST['fecha'];
$idOrden = $_POST['id'] ; // Asegura que 'idOrden' esté definido

if ($total == null || empty($total)) {
    if ($idOrden) {
        header("Location: formDetalleOrden.php?id=$idOrden");
        exit();
    } else {
        echo '<p class="msg-error">Error: No se puede redirigir porque falta el ID de la orden.</p>';
        exit();
    }
}

$res = $controller->procesarOrden($_POST);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/styleResulOp.css">
    <title>Resultado operación</title>
</head>

<body>
    <h1>Resultado de la operación</h1>
    <?php
    if ($res == 'yes') {
        echo '<p class="msg-ok">Datos guardados</p>';
        echo '';
    } else {
        echo  '<p class="msg-error">No se pudo guardar los datos</p>';
    }
    ?>
    <br>
    <a class="botones" href="../inicio.php">Ir a inicio</a>
</body>

</html>