<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Plato.php';
include '../../models/entities/Categoria.php';
include '../../controller/controllerCategorias.php';
include '../../controller/controllerPlatos.php';

use App\controllers\controllerPlatos;
use App\controllers\controllerCategorias;

$controllerPlato = new controllerPlatos();
$controllerCat = new controllerCategorias();
$id = empty($_GET['id']) ? null : $_GET['id'];
$plato = empty($id) ? null : $controllerPlato->getPlato($id);
$cats = $controllerCat->getAllCategorias();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if (empty($id)) {
        echo '<title>Crear Plato</title>';
    } else {
        echo '<title>Modificar Plato</title>';
    }
    ?>
</head>

<body>
    <h1>
        <?php
        if (empty($id)) {
            echo 'Registrar Plato';
        } else {
            echo 'Modificar Plato';
        }
        ?>
    </h1>
    <br>
    <form action="../Actions/savePlato.php" method="post">
        <?php
        if (!empty($id)) {
            echo '<input type="hidden" name="idPlato" value="' . $id . '">';
        }
        ?>
        <div>
            <label for="descripPlato">Descripción</label>
            <input type="text" id="descripPlato" name="descripPlato" value="<?php echo empty($plato) ? '' : $plato->get('descrip') ?>" required>
            <label for="precioPlato">Precio</label>
            <input type="number" id="precioPlato" name="precioPlato" min="0" step="0.01" value="<?php echo empty($plato) ? '' : $plato->get('precio') ?>" required>
            <label for="categoria">Selecciona una categoría:</label>
            <select name="idCat" id="categoria">
                <?php 
                foreach ($cats as $cat) {
                    echo '<option value="'.$cat->get('id').'" id="idCat" name="idCat">'.$cat->get('nombre') .'</option>' ;
                }
                ?>
            </select>
        </div>
        <div>
            <div>
                <button type="submit">Guardar</button>
            </div>
    </form>
    <a href="../AdminCategoria.php">Buscar otra Categoria</a>
    <br>
    <a href="../inicio.php">Ir a inicio</a>
</body>

</html>