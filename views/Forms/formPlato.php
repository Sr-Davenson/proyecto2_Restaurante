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
$id = $controllerPlato->idExiste($id);
$id = empty($_GET['id']) ? null : $_GET['id'];
$plato = empty($id) ? null : $controllerPlato->getPlato($id);
$cats = $controllerCat->getAllCategorias();
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
        echo '<title>Crear Plato</title>';
    } else {
        echo '<title>Modificar Plato</title>';
    }
    ?>
</head>

<body>
    <section class="container">
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
                echo '<div>' .
                    '<label for="descripPlato">Descripción Anterior</label>' .
                    '<input type="text" value=" ' . (empty($plato) ? '' : $plato->get('descrip')) . ' "  disabled>' .
                    '<label for="precioPlato">Precio Anterior</label>' .
                    '<input type="number" value="' . (empty($plato) ? '' : $plato->get('precio')) . '"  disabled>' .
                    '</div>' .
                    '<br>' .
                    '<div>' .
                    '<label for="descripPlato">Descripción Nueva</label>' .
                    '<input type="text" id="descripPlato" name="descripPlato" required>' .
                    '<label for="precioPlato">Precio Nuevo</label>' .
                    '<input type="number" id="precioPlato" name="precioPlato" min="1" step="0.01" min="1" max="99999999.99" required>' .
                    '<div>';
            } else {
                echo '<div>' .
                    '<label for="descripPlato">Descripción</label>' .
                    '<input type="text" id="descripPlato" name="descripPlato" required>' .
                    '<label for="precioPlato">Precio</label>' .
                    '<input type="number" id="precioPlato" name="precioPlato" min="1" max="99999999.99" step="0.01" required>' .
                    '<label for="categoria">Selecciona una categoría:</label>' .
                    '<select name="idCat" id="categoria">';
                foreach ($cats as $cat) {
                    echo '<option value="' . $cat->get('id') . '" id="idCat" name="idCat">' . $cat->get('nombre') . '</option>';
                }
                echo '</select>';
                echo '</div>';
            }
            ?>
            <button type="submit">Guardar</button>
        </form>
        <div class="botones">
            <a href="../AdminPlatos.php">Buscar otro plato</a>
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