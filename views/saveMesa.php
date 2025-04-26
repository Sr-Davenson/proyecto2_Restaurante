<?php
include '../models/connection/conexDB.php';
include '../models/util/model.php';
include '../models/entities/Mesas.php';
include '../controller/controllerMesas.php';

use App\controllers\controllerMesas;

$controller = new controllerMesas();

$nameMesa = ucfirst(strtolower(trim($_POST['nameMesa'])));
if (empty($nameMesa)) {
    echo 'El nombre no puede estar vacío o contener solo espacios.';
    echo '<a href="AdminMesas.php">Ir a inicio</a>';
    exit();
}
if ($controller->mesaExiste($nameMesa)==true) {
    echo 'La mesa <b>'.$nameMesa.'</b> ya está registrada. Ingresa otra.';
    echo '<a href="AdminMesas.php">Ir a inicio</a>';
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
    <title>Resultado operación</title>
</head>

<body>
    <h1>Resultado de la operación</h1>
    <?php
    if ($res == 'yes') {
        echo '<p>Datos guardados</p>';
        echo '<a href="formMesa.php">Crear otra mesa</a>';
    } else {
        echo  '<p>No se pudo guardar los datos</p>';
    }
    ?>
    <br>
    <a href="AdminMesas.php">Buscar otra Mesa</a>
    <br>
    <a href="inicio.php">Ir a inicio</a>
</body>

</html>