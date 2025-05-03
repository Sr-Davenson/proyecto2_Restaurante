<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Plato.php';
include '../../controller/controllerValidaciones.php';
include '../../controller/controllerPlatos.php';

use App\controllers\controllerValidaciones;
use App\controllers\controllerPlatos;


$controller = new controllerPlatos();
$val = new controllerValidaciones();

$descripPlato = $val->formatoTextos('descripPlato');
if (empty($descripPlato)) {
    echo 'El nombre no puede estar vacío o contener solo espacios.';
    echo '<a href="../AdminPlatos.php">Ir a inicio</a>';
    exit();
}

$res = empty($_POST['idPlato'])
    ? $controller->saveNewPlato($_POST)
    : $controller->updatePlato($_POST);

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
    if ($res == 'yes') {
        echo '<p>Datos guardados</p>';
    } else {
        echo  '<p>No se pudo guardar los datos</p>';
    }
    ?>
    <br>
    <a href="../Forms/formPlato.php">Crear otro plato</a>
    <a class="botones" href="../AdminPlatos.php">Buscar otro Plato</a>
    <a href="../inicio.php">Ir a inicio</a>
</body>

</html>