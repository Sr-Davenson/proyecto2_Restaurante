<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Plato.php';
include '../../models/entities/Categoria.php';
include '../../controller/controllerCategorias.php';
include '../../controller/controllerPlatos.php';

use App\controllers\controllerPlatos;
use App\controllers\controllerCategorias;

$search = isset($_POST['search']) ? $_POST['search'] : null;

if ($search == null) {
    header("Location: ../AdminPlatos.php");
}
$controllerPlato = new controllerPlatos();
$controllerCat = new controllerCategorias();
$platos = $controllerPlato->searchPlato($_POST['search']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" conte nt="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/styleSearch.css">
    <title>Buscar Plato</title>
</head>

<body>
    <section class="container">
        
        <?php
        if (empty($platos)) {
            echo ' <h1>Resultados de la operación</h1>';
            echo '<p class="msg-error">No se pudo encontrar ninguna coincidencia.</p>';
        } else {
            echo '<h1>Platos encontradas:</h1>';
            echo '<table class="tabla">';
            echo '<thead>
                    <td>Descripcion</td>
                    <td>Precio</td>
                    <td>Categoria</td>
                    <td>Actualizar</td>
                    <td>Eliminar</td>
                </thead>';
            foreach ($platos as $plato) {
                echo '<tr>';
                $cat = $controllerCat->searchNameCategoria($plato->get('idCat'));
                echo   '<td>' .
                    $plato->get('descrip') .
                    '</td>' .
                    '<td>' .
                    'COP $' . $plato->get('precio') .
                    '</td>' .
                    '<td>' .
                    $cat->get('nombre') .
                    '</td>' .
                    '<td>' .
                    '<a href="../Forms/formPlato.php?id=' . $plato->get('id') . '"> <img src="../../images/update.svg" alt="update"></a>' . '</td>' .
                    '<td>' .
                    ' <a href="deletePlato.php?id=' . $plato->get('id') . '"> <img src="../../images/delete.svg" alt="delete"></a>' . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
        ?>

        <br>
        <div class="botones">
            <a href="../AdminPlatos.php">Buscar otro plato</a>
            <a href="../inicio.php">Ir a inicio</a>
        </div>
    </section>
</body>

</html>