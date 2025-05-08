<<<<<<< HEAD
<?php
include '../models/connection/conexDB.php';
include '../models/util/model.php';
include '../models/entities/Mesas.php';
include '../models/entities/Plato.php';
include '../controller/controllerMesas.php';
include '../controller/controllerPlatos.php';

use App\controllers\controllerMesas;
use App\controllers\controllerPlatos;

// Inicializar los controladores
$mesaController = new controllerMesas();
$platoController = new controllerPlatos();

// Obtener listas de mesas y platos disponibles
$mesas = $mesaController->getAllMesas();
$platos = $platoController->getAllPlatos();

// Inicializar el total de la orden y los detalles
$total = 0;
$detalleOrden = array();

// Procesar la información cuando se envíe el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["platos"])) {
    foreach ($_POST["platos"] as $plato) {
        if (!empty($plato['idPlato']) && isset($plato['cantidad']) && isset($plato['precio'])) {
            $cantidad = intval($plato["cantidad"]);
            $precio = floatval($plato["precio"]);
            $subtotal = $cantidad * $precio;
            $total += $subtotal;

            // Agregar cada plato al detalle de la orden usando `array()`
            $detalleOrden[] = array(
                'idPlato' => $plato['idPlato'],
                'descrip' => htmlspecialchars($plato['descrip']),
                'cantidad' => $cantidad,
                'precio' => number_format($precio, 2),
                'subtotal' => number_format($subtotal, 2)
            );
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura de la Orden</title>
    <link rel="stylesheet" href="../CSS/styleCrearOrden.css">
</head>
<body>
    <h1>Factura de la Orden</h1>

    <form action="" method="POST">
        <label>Fecha de Orden:</label>
        <input type="date" name="fechaOrden" required>

        <label>Seleccione Mesa:</label>
        <select name="idMesa" required>
            <?php foreach ($mesas as $mesa): ?>
                <option value="<?php echo $mesa->get('id'); ?>"><?php echo $mesa->get('nombre'); ?></option>
            <?php endforeach; ?>
        </select>

        <label>Seleccione los Platos:</label>
        <?php foreach ($platos as $plato): ?>
            <div>
                <input type="checkbox" name="platos[<?php echo $plato->get('id'); ?>][idPlato]" value="<?php echo $plato->get('id'); ?>">
                <label><?php echo htmlspecialchars($plato->get('descrip')); ?> - $<?php echo number_format($plato->get('precio'), 2); ?></label>
                <input type="number" name="platos[<?php echo $plato->get('id'); ?>][cantidad]" min="1" value="1">
                <input type="hidden" name="platos[<?php echo $plato->get('id'); ?>][precio]" value="<?php echo $plato->get('precio'); ?>">
            </div>
        <?php endforeach; ?>

        <button type="submit">Generar Factura</button>
    </form>

    <?php if (!empty($detalleOrden)): ?>
        <h2>Detalle de la Orden</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detalleOrden as $item): ?>
                    <tr>
                        <td><?php echo $item['idPlato']; ?></td>
                        <td><?php echo $item['descrip']; ?></td>
                        <td><?php echo $item['cantidad']; ?></td>
                        <td>$<?php echo $item['precio']; ?></td>
                        <td>$<?php echo $item['subtotal']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Total: $<?php echo number_format($total, 2); ?></h3>
    <?php endif; ?>

    <a href="inicio.php">Volver</a>
</body>
</html>
=======
>>>>>>> 70cdb19 (Guardando cambios)
