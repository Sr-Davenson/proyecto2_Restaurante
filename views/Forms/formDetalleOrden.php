<<<<<<< HEAD
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
=======

<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Orden.php';
include '../../models/entities/Plato.php';
include '../../models/entities/detalleOrden.php';
include '../../controller/controllerDetalleOrden.php';

use App\controllers\ControllerDetalleOrden;
use App\controllers\ControllerPlatos;

// Obtener ID de la orden
$id = $_GET['id'] ?? null;

// Verificar si el ID existe y obtener detalles
$controller = new ControllerDetalleOrden();
$detalleOrden = $id ? $controller->obtenerDetallesPorOrden($id) : null;

// Instanciar el controlador de platos
$platoModel = new ControllerPlatos();
$platos = $platoModel->getAllPlatos();

// Verificar que `$platos` sea un array válido
if (!is_array($platos)) {
    die("Error: No se pudieron obtener los platos.");
}
?>

>>>>>>> ff3284fade6d1d116e68d8ed07622d4832619967
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <title>Crear Detalle orden</title>
</head>
<body>
    <h1>Registrar Plato</h1>
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
            echo ' <input type="number" id="cantidad" name="cantidad" min="1" step="0.01" required>';
        }
        ?>
            <br>
        <button type="submit">Guardar</button>
    </form>
    <div class="botones">
        <a href="../CrearOden.php">Volver</a>
    </div>
</body>

</html>
=======
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/styleForms.css">
    <title><?= empty($id) ? 'Crear Detalle de Orden' : 'Modificar Detalle de Orden' ?></title>
</head>

<body>
    <h1><?= empty($id) ? 'Registrar Detalle de Orden' : 'Modificar Detalle de Orden' ?></h1>
    <br>

    <form action="../Actions/detalleOrden.php" method="post">
        <input type="hidden" name="idOrden" value="<?= htmlspecialchars($id); ?>">

        <div>
            <label for="plato">Plato Anterior:</label>
            
            <option value="<?= ($plato['id']); ?>
        </div>

        <div>
            <label for="plato>Seleccionar Nuevo Plato:</label>
            <select id="plato" name="plato">
                <option value="" disabled selected>Seleccione un plato</option>
                <?php foreach ($platos as $plato): ?>
                    <option value="<?= htmlspecialchars($plato['id']); ?>">
                        <?= htmlspecialchars($plato['descripcion']) . ' - $' . htmlspecialchars($plato['precio']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" min="1" required>
        </div>

        <div>
            <label for="precio">Precio Unitario:</label>
            <input type="number" id="precio" name="precio" step="0.01" required>
        </div>

        <div>
            <label for="total">Total:</label>
            <input type="text" id="total" name="total" readonly>
        </div>

        <button type="submit">Guardar</button>
    </form>

    <div class="botones">
        <a href="../detalleOrden.php ">Ver Detalle de Orden</a>
        <br>
        <a href="../inicio.php">Ir a inicio</a>
    </div>

</body>
</html>

>>>>>>> ff3284fade6d1d116e68d8ed07622d4832619967
