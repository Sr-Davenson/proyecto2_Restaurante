<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Plato.php';
include '../../controller/controllerPlatos.php';

use App\controllers\controllerPlatos;

$controller = new controllerPlatos();

$descripPlato = ucfirst(strtolower(trim($_POST['descripPlato'])));
if (empty($descripPlato)) {
    echo 'El nombre no puede estar vacío o contener solo espacios.';
    echo '<a href="../AdminPlatos.php">Ir a inicio</a>';
    exit();
}
// if ($controller->platoExiste($$descripPlato)==true) {
//     echo 'El nombre <b>'.$$descripPlato.'</b> ya está registrado. Ingresa otro.';
//     echo '<a href="AdminPlatos.php">Ir a inicio</a>';
//     exit();
// }

$res = empty($_POST['idPlato'])
    ? $controller->saveNewPlato($_POST)
    : $controller->updatePlato($_POST);

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
        echo '<a href="../Forms/formPlato.php">Crear otro plato</a>';
    } else {
        echo  '<p>No se pudo guardar los datos</p>';
    }
    ?>
    <br>
    <a href="../AdminPlatos.php">Buscar otra Plato</a>
    <br>
    <a href="../inicio.php">Ir a inicio</a>
</body>

</html>