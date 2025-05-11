<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Orden.php';
include '../../models/entities/Mesas.php';
include '../../controller/controllerMesas.php';
include '../../controller/controllerOrden.php';

use App\controllers\controllerOrden;
use App\controllers\controllerMesas;

$controllerOr = new controllerOrden();
$controllerMesa = new controllerMesas();


$fechaIni = isset($_POST['fechaIni']) ? $_POST['fechaIni'] : null;
$fechaFin = isset($_POST['fechaFin']) ? $_POST['fechaFin'] : null;
if ($fechaFin == null && $fechaFin  == null) {
    header("Location: ../Forms/formOrdenActiva.php");
}
$totalRecaudo = 0;

if ($fechaIni && $fechaFin) {
    $os = $controllerOr->filtarPorfechas($fechaIni, $fechaFin);
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
    <?php
    if (empty($os)) {
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
            echo '<td>';

            echo '<input type="datetime-local" value="' . $orden->get('fecha') . '" disabled>' .
                // echo '<p>' . $orden->get('fecha') .
                '</td>' .
                '<td>' .
                'COP $' . $orden->get('total') .
                '</td>' .
                '<td>' .
                $mesa->get('nombre') .
                '</td>' .
                '<td>' .
                '<a  href="../Forms/viewsDetalleOrden.php?id=' . $orden->get('id') . '"> <img src="../../images/Read More.svg" alt="More"></a>' . '</td>' .
                '</p>' .
                '</td>';
            echo '</tr>';
            $totalRecaudo += $orden->get('total');
        }
        echo '<tfoot>
        <td>Total Recaudo</td>
        <td>COP $' . $totalRecaudo . '</td>
        </tfoot>';
        echo '</table>';
    }
    ?>
    <br>
    <div class="botones">
        <a href="../Forms/formOrdenActiva.php">Buscar otro reporte</a>
        <a href="../inicio.php">Ir a inicio</a>
    </div>
</body>

</html>