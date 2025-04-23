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
        echo '<p>Categoría encontrada:</p>';
        echo '<p>' . htmlspecialchars($mesa->get('nombre')) . '</p>';
    }
    ?>
    <br>
    <a href="AdminMesas.php">Buscar otra Mesa</a>
    <a href="inicio.php">I a inicio</a>
</body>
</html>