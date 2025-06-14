<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Orden.php';
include '../../models/entities/Mesas.php';
include '../../models/entities/DetalleOrden.php';
include '../../controller/controllerMesas.php';
include '../../controller/controllerOrden.php';
include '../../controller/controllerDetalleOrden.php';


use App\controllers\controllerDetalleOrden;
use App\controllers\controllerOrden;
use App\controllers\controllerMesas;

$controllerOr = new controllerOrden();
$controllerDetallOrden = new controllerDetalleOrden();
$controllerMesa = new controllerMesas();


$fechaIni = isset($_POST['fechaIni']) ? $_POST['fechaIni'] : null;
$fechaFin = isset($_POST['fechaFin']) ? $_POST['fechaFin'] : null;
$estado = 1;
$totalRecaudo = 0;
if ($fechaFin == null || $fechaFin  == null) {
    header("Location: ../Forms/formOrdenAnulada.php");
    exit();
}
if ($fechaIni && $fechaFin) {
    $os = $controllerOr->filtrarPorFechas($fechaIni, $fechaFin, $estado);
} else {
    $os = [];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../images/log.ico">
    <link rel="stylesheet" href="../../CSS/styleSearch.css">
    <title>Órdenes Anuladas</title>
</head>

<body>
    <section class="container">
        <?php
        if ($fechaIni > $fechaFin) {
            echo '<h1>Resultados de la operación</h1>';
            echo '<p class="msg-error">La fecha de inicio no puede ser mayor que la fecha de fin.</p>';
        } elseif (empty($os)) {
            echo '<h1>Resultados de la operación</h1>';
            echo '<p class="msg-error">No se pudo encontrar ninguna coincidencia.</p>';
        } else {
            echo '<h1>Órdenes Anuladas encontradas:</h1>';
            echo '<table class="tabla">';
            echo '<thead>
                    <td>Fecha</td>
                    <td>Total</td>
                    <td>Mesa</td>
                    <td>Ver detalle</td>
                </thead>';
            foreach ($os as $orden) {
                echo '<tr>';
                $mesa = $controllerMesa->getMesa($orden->get('idMesa'));
                echo '<td>' . $orden->get('fecha') .
                    '</td>' .
                    '<td>' .
                    'COP $' . number_format($orden->get('total'), 2)  .
                    '</td>' .
                    '<td>' .
                    $mesa->get('nombre') .
                    '</td>' .
                    '<td>' .
                    '<a  href="../Forms/viewsDetalleOrden.php?id=' . $orden->get('id') . '"> <img src="../../images/Read More.svg" alt="More"></a>' . '</td>' .
                    '</td>';
                $totalRecaudo += $orden->get('total');
                echo '</tr>';
            }
            echo '<tfoot>
        <tr>
            <td>Total Recaudo</td>
            <td>COP $' . number_format($totalRecaudo, 2)  . '</td>';
            echo '</tfoot>';
            echo '</table>';
        }
        ?>
        <br>
        <div class="botones">
            <a href="../Forms/formOrdenActiva.php">Buscar otro reporte</a>
            <a href="../inicio.php">Ir a inicio</a>
        </div>
    </section>
</body>

</html>