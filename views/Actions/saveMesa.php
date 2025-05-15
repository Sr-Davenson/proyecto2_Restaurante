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
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../images/log.ico">
    <link rel="stylesheet" href="../../CSS/styleResulOp.css">
    <title>Resultado operación</title>
</head>

<body>
    <section class="container">
        <h1>Resultado de la operación</h1>
        <?php
        $nameMesa = isset($_POST['nameMesa']) ? $_POST['nameMesa'] : header("Location: ../AdminMesas.php");
        $nameMesa = $val->formatoTextos($nameMesa);
        $_POST['nameMesa'] = $nameMesa;
        $res = $controller->procesarMesa($nameMesa, $_POST);
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
    </section>
</body>

</html>