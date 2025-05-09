<?php
include '../models/connection/conexDB.php';
include '../models/util/model.php';
include '../models/entities/Orden.php';
include '../models/entities/Mesas.php';
include '../controller/controllerMesas.php';
include '../controller/controllerOrden.php';

use App\controllers\controllerOrden;
use App\controllers\controllerMesas;

$controllerOrden = new controllerOrden();
$controllerMesa = new controllerMesas();
$id = empty($_GET['id']) ? null : $_GET['id'];
$mesas = $controllerMesa->getAllMesas();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/styleForms.css">
    <title>Crear Orden</title>
</head>

<body>
    <h1>Iniciar Orden</h1>
    <br>
    <form action="Actions/saveOrden.php" method="post">
    <label for="fecha">Fecha Orden:</label>
    <input type="datetime-local" name="fecha" id="fecha" required>

        <label for="total">Total</label>
        <?php
        echo '<input type="number" value="0" readonly disabled>';
        echo '<div>' .
            '<label for="categoria">Selecciona una mesa:</label>';
        echo'<select name="idMesa" id="mesas">';
        foreach ($mesas as $mesa) {
            echo '<option value="' . $mesa->get('id') . '">' . $mesa->get('nombre') . '</option>';
        }
        echo '</select>';

        echo '</div>';
        ?>
        <button type="submit">Guardar</button>
    </form>
    <div class="botones">
        <a href="inicio.php">Ir a inicio</a>
    </div>
</body>

</html>