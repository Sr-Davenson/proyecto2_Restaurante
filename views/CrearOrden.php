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
$mesas = $controllerMesa->getAllMesas();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styleCrearOrden.css">
    <title>Crear Orden</title>
</head>

<body>
    <section class="container">
        <h1>Orden</h1>
        <form action="Actions/saveOrden.php" method="post">
            <label for="fecha">Fecha Orden:</label>
            <input type="datetime-local" name="fecha" id="fecha" required>

            <label for="mesa">Mesa:</label>
            <select name="idMesa">
                <?php
                foreach ($mesas as $mesa) {
                    echo '<option value="' . $mesa->get('id') . '">' . $mesa->get('nombre') . '</option>';
                }
                ?>
            </select>
            <h1>Registrar Pedido</h1>

            <h2>Seleccionar los platos</h2>
            <?php

            foreach ($platos as $plato) {
                echo '<input type="checkbox" name="idPlato[]" value="' . $plato->get('id') . '">';
                echo '<label>' . $plato->get('descrip') . ' ($' . $plato->get('precio') . ')</label>';
                echo '<input type="number" name="cantidad[' . $plato->get('id') . ']" min="1" value="1">';
            }
            ?>

            <button type="submit">Guardar Orden</button>
        </form>
        <a href="inicio.php">Ir a inicio</a>
    </section>
</body>

</html>