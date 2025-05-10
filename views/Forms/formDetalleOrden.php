<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/DetalleOrden.php';
include '../../models/entities/Plato.php';
include '../../controller/controllerPlatos.php';
include '../../controller/controllerDetalleOrden.php';

use App\controllers\controllerDetalleOrden;
use App\controllers\controllerPlatos;

$controllerOrden = new controllerDetalleOrden();
$controllerPlato = new controllerPlatos();
$platos = $controllerPlato->getAllPlatos();


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Detalle orden</title>
</head>
<body>
    <h1>Registrar Pedido</h1>
    <br>
    <form action="../Actions/saveDetalleOrden.php" method="post">
        <?php
        foreach ($platos as $plato) {
            echo '<br>';
            echo '<label for="descrip">'. $plato->get('descrip') .'</label>';
            echo '<input type="checkbox" value="' . $plato->get('id') . '" id="idCat" name="idCat"></input>';
            echo '<br>';
            echo '<label for="Precio">Precio</label>';
            echo '<input type="number" value="' . (empty($plato) ? '' : $plato->get('precio')) . '"  disabled> ';
            echo '<label for="cantidad">Cantidad plato</label>';
            echo ' <input type="number" id="cantidad" name="cantidad" min="1" required>';
        }
        ?>
            <br>
        <button type="submit">Guardar</button>
    </form>
    <div class="botones">
        <a href="../inicio.php">Volver</a>
    </div>
</body>

</html>