<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/DetalleOrden.php';
include '../../models/entities/Plato.php';
include '../../controller/controllerPlatos.php';
include '../../controller/controllerDetalleOrden.php';

use App\controllers\controllerDetalleOrden;
use App\controllers\controllerPlatos;

$controllerPlato = new controllerPlatos();
$controllerDetalleOrden = new controllerDetalleOrden();
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
    $res = $controller->procesarDetalleOrden($_POST);
    if ($res == 'yes') {
        echo '<p class="msg-ok">Datos guardados</p>';
        echo '';
    } else {
        echo  '<p class="msg-error">No se pudo guardar los datos</p>';
    }
    ?>
    <br>
    <a class="botones" href="../CrearOden.php">Continuar</a>
</body>

</html>