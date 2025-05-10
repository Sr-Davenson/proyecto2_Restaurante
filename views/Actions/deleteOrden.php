<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Orden.php';
include '../../controller/controllerOrden.php';

use App\controllers\controllerOrden;

$controller = new controllerOrden();

if (isset($_POST['idOrden']) && isset($_POST['confirmar'])) {
    $idOrden = $_POST['idOrden'];
    $switch = $_POST['confirmar'];
    switch ($res) {
        case '1':
            $res = $controller->removeOrden($_GET['id']);
            echo '<p class="msg-ok">Datos borrados</p>';
            break;
        case '2':
            echo  '<p class="msg-error">No se pudo borrar los datos</p>';
            break;
        default:
            echo  '<p class="msg-error">El registro no existe</p>';
            break;
    }
    header("Location: ../inicio.php");
    exit();
}
