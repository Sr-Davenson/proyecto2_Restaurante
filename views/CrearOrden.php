<?php
include '../models/connection/conexDB.php';
include '../models/util/model.php';
include '../models/entities/Orden.php';
include '../models/entities/Mesas.php';
include '../models/entities/Plato.php';
include '../controller/controllerPlatos.php';
include '../controller/controllerMesas.php';
include '../controller/controllerOrden.php';

use App\controllers\controllerOrden;
use App\controllers\controllerMesas;
use App\controllers\controllerPlatos;


$controllerOrden = new controllerOrden();
$controllerMesa = new controllerMesas();
$controllerPlato = new controllerPlatos();
$platos = $controllerPlato->getAllPlatos();
$id = empty($_GET['id']) ? null : $_GET['id'];
$mesas = $controllerMesa->getAllMesas();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Orden</title>
</head>

<body>
    <h1>Orden</h1>
    <form action="Actions/saveOrden.php" method="post">
        <label for="fecha">Fecha Orden:</label>
        <input type="datetime-local" name="fecha" id="fecha" required>

        <label for="mesa">Mesa:</label>
        <select name="idTable">
            <?php
            foreach ($mesas as $mesa) {
                echo '<option value="' . $mesa->get('id') . '">' . $mesa->get('nombre') . '</option>';
            }
            ?>
        </select>
        <h1>Registrar Pedido</h1>

        <h3>Selecciona los platos:</h3>
        <?php

        foreach ($platos as $plato) {
            echo '<input type="checkbox" name="idPlato[]" value="' . $plato->get('id') . '">';
            echo '<label>' . $plato->get('descrip') . ' ($' . $plato->get('precio') . ')</label>';
            echo '<input type="number" name="cantidad[' . $plato->get('id') . ']" min="0" value="0">';
        }
        ?>

        <button type="submit">Guardar Orden</button>
    </form>
    <a href="inicio.php">Ir a inicio</a>
</body>

</html>