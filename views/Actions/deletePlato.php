<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Plato.php';
include '../../controller/controllerPlatos.php';

use App\controllers\controllerPlatos;

$controller = new controllerPlatos();
isset($_GET['id']) ? $_GET['id'] : header("Location: ../AdminPlatos.php");
$res = $controller->removePlato($_GET['id']);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../images/log.ico">
    <link rel="stylesheet" href="../../CSS/styleResulOp.css">
    <title>Eliminar Plato</title>
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
            echo  '<p class="msg-error">No se puede eliminar el plato, Tiene una orden asociada.</p>';
            break;
        default:
            echo  '<p class="msg-error">El registro no existe</p>';
            break;
    }
    ?>
    <br>
    <a class="botones" href="searchPlato.php">Volver</a>
    </div>
</body>

</html>