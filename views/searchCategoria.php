<?php
include '../models/connection/conexDB.php';
include '../models/util/model.php';
include '../models/entities/categoria.php';
include '../controller/controllerCategorias.php';

use App\controllers\controllerCategorias;


$controller = new controllerCategorias();
$cat = $controller->searchCategoria($_POST['search']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/acciones.css">
    <title>Buscar Categoria</title>
</head>
<body>
    <h1>Resultados de la operación</h1>
    <?php
    
    if (!$cat) {
        echo '<p class="msg-error">No se pudo encontrar ninguna coincidencia.</p>';
    } else {
        echo '<p>Categoría encontrada:</p>';
        echo '<p>' . htmlspecialchars($cat->get('nombre')) . '</p>';
    }
    ?>
    <br>
    <a href="AdminCategoria.php">Buscar otra categoria</a>
    <a href="inicio.php">Ir a inicio</a>
</body>
</html>