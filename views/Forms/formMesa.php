<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Mesas.php';
include '../../controller/controllerMesas.php';

use App\controllers\controllerMesas;

$controller = new controllerMesas();
$id = empty($_GET['id']) ? null : $_GET['id'];
$mesa = empty($id) ? null : $controller->getMesa($id);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/styleForms.css">
    <?php
    if (empty($id)) {
        echo '<title>Crear Mesa</title>';
    } else {
        echo '<title>Modificar Mesa</title>';
    }
    ?>
</head>

<body>
    <h1>
        <?php
        if (empty($id)) {
            echo 'Registrar Mesa';
        } else {
            echo 'Modificar mesa';
        }
        ?>
    </h1>
    <br>
    <form action="../Actions/saveMesa.php" method="post">
        <?php
        if (!empty($id)) {
            echo '<input type="hidden" name="idMesa" value="' . $id . '">';
        }
        ?>
        <div>
            <label for="nameMesa">Nombre</label>
            <input type="text" id="nameMesa" name="nameMesa" value="<?php echo empty($mesa) ? '' : $mesa->get('nombre') ?>" required>
        </div>
        <div>
            <div>
                <button type="submit">Guardar</button>
            </div>
    </form>
    <a href="../AdminMesas.php">Buscar otra Mesa</a>
    <br>
    <a href="../inicio.php">Ir a inicio</a>
</body>

</html>