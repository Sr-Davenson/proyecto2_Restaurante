<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../../CSS/style.Ordenes.css">
    <title>Ordenes Activas</title>

</head>

<body>
    <section class="container">
        <h1>
            <h1>Fechas Activadas</h1>
        </h1>
        <br>
        <form class="form" action="../Actions/searchOrdenActiva.php" method="post">
            <div>
                <label for="fechaIni">Fecha Inicio:</label>
                <input type="date" id="fechaIni" name="fechaIni" required>
                <label for="fechaFin">Fecha Fin:</label>
                <input type="date" id="fechaFin" name="fechaFin" required>
            </div>

            <button type="submit">Buscar</button>
        </form>
        <div class="botones">
            <a href="../AdminOrdenes.php">Volver</a>
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