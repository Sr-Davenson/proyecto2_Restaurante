<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Orden.php';
include '../../controller/controllerOrden.php';

use App\controllers\controllerOrden;

$controller = new controllerOrden();

$fechaIni = isset($_POST['fechaIni']) ? $_POST['fechaIni'] : null;
$fechaFin = isset($_POST['fechaFin']) ? $_POST['fechaFin'] : null;

if ($fechaIni && $fechaFin) {
    $os = $controller->filtarPorfechas($fechaIni, $fechaFin);
} else {
    $os = [];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/styleSearch.css">
    <title>Órdenes Activas</title>
</head>

<body>
    <?php
    if (empty($os)) {
        echo '<h1>Resultados de la operación</h1>';
        echo '<p class="msg-error">No se pudo encontrar ninguna coincidencia.</p>';
    } else {
        echo '<h1>Órdenes encontradas:</h1>';
        echo '<ul>';
        foreach ($os as $orden) {
            echo '<p>ID: ' . $orden->get('id') . ', Fecha: ' . $orden->get('fecha') . ', Total: COP $' . $orden->get('total') . ', Mesa: ' . $orden->get('idMesa') . '</p>';
        }
        echo '</ul>';
    }
    ?>
    <br>
    <div class="botones">
        <a href="../AdminPlatos.php">Buscar otro plato</a>
        <a href="../inicio.php">Ir a inicio</a>
    </div>
</body>

</html>