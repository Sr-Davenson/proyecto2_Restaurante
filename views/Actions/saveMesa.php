<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Mesas.php';
include '../../controller/controllerMesas.php';
include '../../controller/controllerValidaciones.php';


use App\controllers\controllerMesas;
use App\controllers\controllerValidaciones;

$controller = new controllerMesas();
$val = new controllerValidaciones();

$nameMesa = $val->formatoTextos('nameMesa');


if (empty($nameMesa)) {
    echo 'El nombre no puede estar vacío o contener solo espacios.';
    echo '<a href="../AdminMesas.php">Ir a inicio</a>';
    exit();
}
if ($controller->mesaExiste($nameMesa)==true) {
    echo 'La mesa <b>'.$nameMesa.'</b> ya está registrada. Ingresa otra.';
    echo '<a href="../AdminMesas.php">Ir a inicio</a>';
    exit();
}
$_POST['nameMesa'] = $nameMesa;
$res = empty($_POST['idMesa'])
    ? $controller->saveNewMesas($_POST)
    : $controller->updateMesas($_POST);
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
    <a class="botones" href="../Forms/formMesa.php">Crear otra mesa</a>
    <a class="botones" href="../AdminMesas.php">Buscar otra Mesa</a>
    <a class="botones" href="../inicio.php">Ir a inicio</a>
</body>

</html>