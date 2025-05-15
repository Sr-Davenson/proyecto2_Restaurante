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

use App\controllers\controllerDetalleOrden;
use App\controllers\controllerOrden;
use App\controllers\controllerMesas;
use App\controllers\controllerPlatos;


$controllerOrden = new controllerOrden();
$controllerMesa = new controllerMesas();
$controllerPlato = new controllerPlatos();
$controllerDetallOrden = new controllerDetalleOrden();


$id = empty($_GET['id']) ? null : $_GET['id'];
if ($id == null) {
    header("Location: ../AdminOrdenes.php");
    exit();
}
$id = $controllerOrden->idExiste($id);
$id = empty($_GET['id']) ? null : $_GET['id'];
$orden = empty($id) ? null : $controllerOrden->getOrden($id);
$mesa = $controllerMesa->searchNameMesa($orden->get('idMesa'));
$detalleOrdenes = $controllerDetallOrden->getAllDetalleOrden($id);

$i = 0;
$totalRecaudo = 0;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../images/log.ico">
    <link rel="stylesheet" href="../../CSS/style.Ordenes.css">
    <title>Ver Detalle Orden</title>
</head>

<body>
    <section class="container">
        <h1>Detalle Orden</h1>
        <form action="../Actions/anularOrden.php" method="post">
            <label for="fecha">Fecha Orden:</label>
            <input type="datetime-local" value="<?php echo $orden->get('fecha') ?>" disabled>

            <label for="mesa">Mesa:</label>
            <input type="text" value="<?php echo $mesa->get('nombre') ?>" disabled>
            <?php
            if ($orden->get('estado') == 0) {
                $estado = 'Activo';
                echo '<input type="hidden" name="idOrden" value="' . $orden->get('id') . '">';
                echo '<label for="mesa">Estado:</label>';
                echo '<input type="text" value="' . $estado . '" disabled>';
                echo '<button type="submit">Anular Orden</button>';
            } else {
                $estado = 'Anulada';
                echo '<label for="mesa">Estado:</label>';
                echo '<input type="text" value="' . $estado . '" disabled>';
            }

            ?>
        </form>

        <h1>Factura</h1>
        <?php
        echo '<table class="tabla" border="1px">';
        echo '<thead>
                    <td>Item</td>
                    <td>Descripcion</td>
                    <td>Cantidad</td>
                    <td>Precio Unitario</td>
                    <td>SubTotal</td>
                </thead>';
        foreach ($detalleOrdenes as $detallOrd) {
            $platos = $controllerPlato->getPlato($detallOrd->get('idPlato'));
            echo '<tr>';
            echo '<td>' . $i += 1;
            echo '</td>';
            echo '<td>';
            echo $platos->get('descrip');
            echo  '</td>';
            echo  '<td>';
            echo  $detallOrd->get('cantidad');
            echo '</td>';
            echo '<td>';
            echo $detallOrd->get('precio');
            echo '</td>';
            echo '<td>';
            echo $subTotal =  $detallOrd->get('cantidad') * $detallOrd->get('precio');
            echo '</td>';
            echo '<br>';
            $totalRecaudo += $subTotal;
        }
        echo '<tfoot>
        <td>Total Recaudo</td>
        <td>COP $' . $totalRecaudo . '</td>
        </tfoot>';
        echo '</table>';
        ?>
        <div class="botones">
            <a href="../inicio.php">Ir a inicio</a>
        </div>
        
    </section>
</body>

</html>