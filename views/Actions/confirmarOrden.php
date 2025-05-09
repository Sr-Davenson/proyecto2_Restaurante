<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Orden.php';
include '../../controller/controllerOrden.php';

use App\controllers\controllerOrden;

$controller = new controllerOrden();
// $id = isset($_GET['id']) ? $_GET['id'] : header("Location: ../inicio.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/styleResulOp.css">
    <title>Confirmación</title>
</head>

<body>
    <h1>¿Deseas confirmar la acción?</h1>
    
    <form action="procesarConfirmacion.php" method="POST">
        <input type="hidden" name="idOrden" value="<?php echo $id; ?>">
        
        <button type="submit" name="confirmar" value="1">Sí</button>
        <button type="submit" name="confirmar" value="2">No</button>
    </form>

    <br>
    <a class="botones" href="searchPlato.php">Volver</a>
</body>
</html>