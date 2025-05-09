<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Orden.php';
include '../../controller/controllerOrden.php';

use App\controllers\controllerOrden;
$controller = new controllerOrden();
// $fecha = isset($_POST['dateOrder']) ? $_POST['dateOrder'] : null;
// $total = isset($_POST['total']) ? $_POST['total'] : null;
if (isset($_POST['fecha'])) {
    $fecha = date('Y-m-d H:i:s', strtotime($_POST['fecha'])); // Formato correcto

    echo "Fecha recibida: " . htmlspecialchars($fecha);
} else {
    echo "No se envió ninguna fecha.";
}
$res = $controller->procesarOrden($fecha,$_POST);

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