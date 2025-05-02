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

$nameCat = $val->formatoTextos('nameCat');
if (empty($nameCat)) {
    echo 'El nombre no puede estar vacío o contener solo espacios.';
    echo '<a href="../AdminCategoria.php">Ir a inicio</a>';
    exit();
}
if ($controller->categoriaExiste($nameCat) == true) {
    echo 'El nombre <b>' . $nameCat . '</b> ya está registrado. Ingresa otro.';
    echo '<a href="../AdminCategoria.php">Ir a inicio</a>';
    exit();
}

$_POST['nameCat'] = $nameCat;
$res = empty($_POST['idCat'])
    ? $controller->saveNewCategoria($_POST)
    : $controller->updateCategoria($_POST);

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
        echo '<a href="../Forms/formCat.php">Crear otra Categoria</a>';
    } else {
        echo  '<p>No se pudo guardar los datos</p>';
    }
    ?>
    <br>
    <a href="../AdminCategoria.php">Buscar otra Categoria</a>
    <br>
    <a href="../inicio.php">Ir a inicio</a>
</body>

</html>