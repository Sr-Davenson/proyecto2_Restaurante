<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Categoria.php';
include '../../controller/controllerCategorias.php';

use App\controllers\controllerCategorias;

$controller = new controllerCategorias();
$id = empty($_GET['id']) ? null : $_GET['id'];
$id = $controller->idExiste($id);
$id = empty($_GET['id']) ? null : $_GET['id'];
$cat = empty($id) ? null : $controller->getCategoria($id);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../images/log.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../../CSS/styleForms.css">
    <?php
    if (empty($id)) {
        echo '<title>Crear Categoria</title>';
    } else {
        echo '<title>Modificar Categoria</title>';
    }
    ?>
</head>


<body>

    <section class="container">
        <h1>
            <?php
            if (empty($id)) {
                echo 'Registrar Categoria';
            } else {
                echo 'Modificar Categoria';
            }
            ?>
        </h1>
        <br>
        <form class="form" action="../Actions/saveCat.php" method="post">
            <?php
            if (!empty($id)) {
                echo '<input type="hidden" name="idCat" value="' . $id . '">';
                echo '<div>' .
                    '<label for="nameCat">Nombre Anterior:</label>' .
                    '<input type="text" value="' . (empty($cat) ? '' : $cat->get('nombre')) . '"  disabled>' .
                    '</div>' .
                    '<div>' .
                    '<label for="nameCat">Nuevo Nombre:</label>' .
                    '<input type="text" id="nameCat" name="nameCat" maxlength="10" required>' .
                    '</div>';
            } else {
                echo '<div>' .
                    '<label for="nameCat">Nombre:</label>' .
                    '<input type="text" id="nameCat" name="nameCat" maxlength="10" required>' .
                    '</div>';
            }
            ?>
            <button type="submit">Guardar</button>
        </form>
        <div class="botones">
            <a href="../AdminCategoria.php">Buscar otra Categoria</a>
            <br>
            <a href="../inicio.php">Ir a inicio</a>
        </div>

    </section>
    <footer>
            <img src="../../images/log.jpg" alt="logo"></img>
            <p>&copy; FRECH FOOD - Todos los derechos reservados</p>
            <p>Teléfono: (+57 1) 123 4567</p>
            <p>Dirección: Calle 20 #10-15., Tunja, Boyacá, Colombia</p>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-x-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
            <br><br>
    </footer>
</body>

</html>