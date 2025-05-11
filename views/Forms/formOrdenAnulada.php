<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/styleForms.css">
    <title>Ordenes Anuladas</title>

</head>

<body>
    <h1>
        <h1>Fechas</h1>
    </h1>
    <br>
    <form class="form" action="../Actions/searchOrdenAnulada.php" method="post">
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
</body>

</html>