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
$estado = 0;
if ($fechaIni == null || $fechaFin  == null) {
    header("Location: ../Forms/formOrdenActiva.php");
    exit();
}
$totalRecaudo = 0;

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
    <link rel="stylesheet" href="../../CSS/styleSearch.css">
    <title>Órdenes Activas</title>
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
            echo '<h1>Órdenes encontradas:</h1>';
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
                echo '<td>' . $orden->get('fecha') . '</td>' .
                    '<td>' . 'COP $' . number_format($orden->get('total'), 2) . '</td>' .
                    '<td>' . $mesa->get('nombre') . '</td>' .
                    '<td>' . '<a  href="../Forms/viewsDetalleOrden.php?id=' . $orden->get('id') . '"> <img src="../../images/Read More.svg" alt="More"></a>' .
                    '</td>';
                echo '</tr>';
                $totalRecaudo += $orden->get('total');
            }
            $ranking = $controllerDetallOrden->obtenerRanking($estado, $fechaFin, $fechaIni);

            echo '<tfoot>
        <tr>
            <td>Total Recaudo</td>
            <td>COP $' . number_format($totalRecaudo, 2) . '</td>';

            if (!empty($ranking)) {
                echo '<tr><td colspan="2"><b>Platos Más Vendidos</b></td></tr>';
                foreach ($ranking as $plato) {
                    echo '<tr><td>' . $plato['nombre'] . '</td><td>' . $plato['total_vendido'] . '</td></tr>';
                }
            }
            echo '</tfoot>
        </table>';
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