<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Mesas.php';
include '../../controller/controllerMesas.php';

use App\controllers\controllerMesas;

$controller = new controllerMesas();

isset($_GET['id']) ?  $_GET['id'] : header("Location: ../AdminMesas.php");
$res = $controller->removeMesas($_GET['id']);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../images/log.ico">
    <link rel="stylesheet" href="../../CSS/styleResulOp.css">
    <title>Eliminar Mesa</title>
</head>

<body>
    <div class="container">
    <h1>Resultados de la operacion</h1>
    <?php
    switch ($res) {
        case '1':
            echo '<p class="msg-ok">Datos borrados</p>';
            break;
        case '2':
            echo  '<p class="msg-error">No se pudo borrar los datos</p>';
            break;
        case '3':
            echo  '<p class="msg-error">No se puede eliminar la mesa, Tiene ordenes asociadas.</p>';
            break;
        default:
            echo  '<p class="msg-error">El registro no existe</p>';
            break;
    }
    ?>
    <br>
    <a class="botones" href="searchMesa.php">Volver</a>
    </div>
</body>

</html>