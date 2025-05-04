
<?php
use App\controllers\controllerMesas;
use App\controllers\controllerPlatos;
use App\controllers\controllerOrdenes;

$mesaController = new controllerMesas();
$platoController = new controllerPlatos();
$ordenController = new controllerOrdenes();

// Obtener listas de mesas y platos disponibles
$mesas = $mesaController->getAllMesas();
$platos = $platoController->getAllPlatos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Orden</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function calcularTotal() {
            let total = 0;
            let platos = document.querySelectorAll('.plato-item');
            
            platos.forEach(plato => {
                let cantidad = parseInt(plato.querySelector('.cantidad').value);
                let precio = parseFloat(plato.querySelector('.precio').value);
                total += cantidad * precio;
            });

            document.getElementById('totalOrden').innerText = 'Total: $' + total.toFixed(2);
            document.getElementById('totalInput').value = total;
        }
    </script>
</head>
<body>
    <h1>Registrar Nueva Orden</h1>
    <form action="procesarOrden.php" method="POST">
        <label>Fecha de Orden:</label>
        <input type="date" name="fechaOrden" required>

        <label>Seleccione Mesa:</label>
        <select name="idMesa" required>
            <?php foreach ($mesas as $mesa): ?>
                <option value="<?= $mesa->id; ?>"><?= $mesa->nombre; ?></option>
            <?php endforeach; ?>
        </select>

        <h3>Seleccione los Platos:</h3>
        <?php foreach ($platos as $plato): ?>
            <div class="plato-item">
                <input type="checkbox" name="platos[<?= $plato->id; ?>][idPlato]" value="<?= $plato->id; ?>" onchange="calcularTotal()">
                <label><?= $plato->descrip; ?> - $<?= $plato->precio; ?></label>
                <input type="number" name="platos[<?= $plato->id; ?>][cantidad]" class="cantidad" min="1" value="1" onchange="calcularTotal()">
                <input type="hidden" name="platos[<?= $plato->id; ?>][precio]" class="precio" value="<?= $plato->precio; ?>">
            </div>
        <?php endforeach; ?>

        <p id="totalOrden">Total: $0.00</p>
        <input type="hidden" name="total" id="totalInput">

        <button type="submit">Registrar Orden</button>
    </form>
</body>
</html>