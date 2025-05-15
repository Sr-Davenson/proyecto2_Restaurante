<?php
include '../../models/connection/conexDB.php';
include '../../models/util/model.php';
include '../../models/entities/Mesas.php';
include '../../controller/controllerMesas.php';

use App\controllers\controllerMesas;

$controller = new controllerMesas();
$id = empty($_GET['id']) ? null : $_GET['id'];
$id = $controller->idExiste($id);
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

    <section class="container">
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
                echo '<div>' .
                    '<label for="nameMesa">Nombre Anterior:</label>' .
                    '<input type="text" value="' . (empty($mesa) ? '' : $mesa->get('nombre')) . '" disabled>' .
                    '</div>' .
                    '<div>' .
                    '<label for="nameMesa">Nuevo Nombre:</label>' .
                    '<input type="text" id="nameMesa" name="nameMesa" required>' .
                    '</div>';
            } else {
                echo '<div>' .
                    '<label for="nameMesa">Nombre:</label>' .
                    '<input type="text" id="nameMesa" name="nameMesa" required>' .
                    '</div>';
            }
            ?>
            <button type="submit">Guardar</button>
        </form>
        <div class="botones">
            <a href="../AdminMesas.php">Buscar otra Mesa</a>
            <br>
            <a href="../inicio.php">Ir a inicio</a>
        </div>
    </section> 
     <footer class="footer">
        <div>
            <img src="../../images/log.jpg" alt="logo"></img>
            <p>&copy; FRECH FOOD - Todos los derechos reservados</p>
            <p>Teléfono: (+57 1) 123 4567</p>
            <p>Dirección: Calle 20 #10-15., Tunja, Boyacá, Colombia</p>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-x-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
            <br><br>
        </div>
    </footer>   
</body>

</html>