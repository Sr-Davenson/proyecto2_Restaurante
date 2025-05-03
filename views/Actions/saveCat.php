<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Categoria.php';
include '../../controller/controllerCategorias.php';
include '../../controller/controllerValidaciones.php';

use App\controllers\controllerCategorias;
use App\controllers\controllerValidaciones;

$controller = new controllerCategorias();
$val = new controllerValidaciones();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/styleResulOp.css">
    <title>Resultado operación</title>
</head>

<body>
    <h1>Resultado de la operación</h1>
    <?php
    $nameCat = isset($_POST['nameCat']) ? $_POST['nameCat'] : header("Location: ../AdminCategoria.php");
    $nameCat = $val->formatoTextos('nameCat');
    $res = $controller->procesarCategoria($nameCat, $_POST);
    if ($res == 'yes') {
        echo '<p class="msg-ok">Datos guardados</p>';
        echo '';
    } else {
        echo  '<p class="msg-error">No se pudo guardar los datos</p>';
    }
    ?>
    <br>
    <a class="botones" href="../Forms/formCat.php">Crear otra Categoria</a>
    <a class="botones" href="../AdminCategoria.php">Buscar otra Categoria</a>
    <a class="botones" href="../inicio.php">Ir a inicio</a>
</body>

</html>