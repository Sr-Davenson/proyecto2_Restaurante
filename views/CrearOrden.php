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

// Verificar si las listas están vacías
if (!$mesas || count($mesas) == 0) {
    echo "<p style='color: red;'>Error: No hay mesas disponibles.</p>";
}

if (!$platos || count($platos) == 0) {
    echo "<p style='color: red;'>Error: No hay platos disponibles.</p>";
}
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
                if (plato.querySelector('.plato-checkbox').checked) {
                    total += cantidad * precio;
                }
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
                <?php foreach ($mesas as $mesa){
                    echo '<option value="'.$mesa->get('id').'"  id="idMesa" name="idMesa">' . $mesa->get('nombre') . '</option>';
                 } ?>
        </select>
        <label>Seleccione los Platos:</label>
        <div class="plato-item">
            <?php foreach ($platos as $plato){
                echo '<input type="checkbox" value="'.$plato->get('id').'"  id="idPlato" name="idPlato">' . $plato->get('descrip').', $'. $plato->get('precio').'<br>';
            }?>
                </div>
        <p id="totalOrden">Total: $0.00</p>
        <input type="hidden" name="total" id="totalInput">

        <button type="submit" <?= (!$mesas || count($mesas) == 0 || !$platos || count($platos) == 0) ? 'disabled' : ''; ?>>Registrar Orden</button>
    </form>
    <a href="inicio.php">Volver</a>

</body>
</html>