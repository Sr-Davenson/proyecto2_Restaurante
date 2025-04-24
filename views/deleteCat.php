<?php
include '../models/connection/conexDB.php';
include '../models/util/model.php';
include '../models/entities/Categoria.php';
include '../controller/controllerCategorias.php';

use App\controllers\controllerCategorias;

$controller = new controllerCategorias();

$res = $controller->removeCategoria($_GET['id']);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Categoria</title>
</head>

<body>
    <h1>Resultados de la operacion</h1>
    <?php
    switch ($res) {
        case 'yes':
            echo '<p class="msg-ok">Datos borrados</p>';
            break;
        case 'not':
            echo  '<p class="msg-error">No se pudo borrar los datos</p>';
            break;
        default:
            echo  '<p class="msg-error">El registro no existe</p>';
            break;
    }
    ?>
    <br>
    <a href="searchCategoria.php">Volver</a>
</body>

</html>