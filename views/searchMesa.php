<?php
include '../models/connection/conexDB.php';
include '../models/util/model.php';
include '../models/entities/Mesas.php';
include '../controller/controllerMesas.php';

use App\controllers\controllerMesas;


$controller = new controllerMesas();
$mesa = $controller->searchMesa($_POST['search']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/acciones.css">
    <title>Buscar Mesa</title>
</head>

<body>
    <h1>Resultados de la operación</h1>
    <?php

    if (!$mesa) {
        echo '<p class="msg-error">No se pudo encontrar ninguna coincidencia.</p>';
    } else {
        echo '<p>Mesa encontrada:</p>';
        echo '<p>' . $mesa->get('nombre') . '</p>';
        echo '<a href="formMesa.php?id=' . $mesa->get('id') . '">
            <img src="../images/update.svg" alt="update">
            </a>';
    }
    ?>
    <br>
    <a href="AdminMesas.php">Buscar otra Mesa</a>
    <br>
    <a href="inicio.php">Ir a inicio</a>
</body>

</html>