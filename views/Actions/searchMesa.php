<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Mesas.php';
include '../../controller/controllerMesas.php';

use App\controllers\controllerMesas;

$search = isset($_POST['search']) ? $_POST['search'] : null;

if ($search == null) {
    header("Location: ../AdminMesas.php");
}
$controller = new controllerMesas();
$mesas = $controller->searchMesa($search);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/styleSearch.css">
    <title>Buscar Mesa</title>
</head>

<body>
    <?php

    if (!$mesas) {
        echo '<h1>Resultados de la operación</h1>';
        echo '<p class="msg-error">No se pudo encontrar ninguna coincidencia.</p>';
    } else {
        echo '<table class="tabla">';
        echo '<thead>
                    <td>Nombre</td>
                    <td>Actualizar</td>
                    <td>Eliminar</td>
                </thead>';
        echo '<h1>Mesas encontradas:</h1>';
        echo '<ul>';
        foreach ($mesas as $mesa) {
             echo '<tr>
                    <td>';
            echo '<p>' . $mesa->get('nombre') . 
              '</td>' .
                '<td>' .
                '<a href="../Forms/formMesa.php?id=' . $mesa->get('id') . '"> <img src="../../images/update.svg" alt="update"></a>' . '</td>' .
                '<td>' .
                ' <a href="deleteMesa.php?id=' . $mesa->get('id') . '"> <img src="../../images/delete.svg" alt="delete"></a>'. '</td>' 
                . '</p>';
        echo '</tr>';
        }
        echo '</table>';
    }
    ?>
    <br>
    <div class="botones">
        <a href="../AdminMesas.php">Buscar otra Mesa</a>
        <a href="../inicio.php">Ir a inicio</a>
    </div>
</body>

</html>