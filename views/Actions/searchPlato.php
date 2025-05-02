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
    <?php
    if (empty($platos)) {
        echo ' <h1>Resultados de la operación</h1>';
        echo '<p class="msg-error">No se pudo encontrar ninguna coincidencia.</p>';
    } else {
        echo '<h1>Platos encontradas:</h1>';
        echo '<ul>';
        foreach ($platos as $plato) {
            $cat = $controllerCat->searchNameCategoria($plato->get('idCat'));
            echo '<p>' . $plato->get('descrip') . ', Precio: COP $' . $plato->get('precio') . ', Categoría: ' . $cat->get('nombre') .
                '<a href="../Forms/formPlato.php?id=' . $plato->get('id') . '"> <img src="../../images/update.svg" alt="update"></a>' .
                ' <a href="deletePlato.php?id=' . $plato->get('id') . '"> <img src="../../images/delete.svg" alt="delete"></a>' .
                '</p>';
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