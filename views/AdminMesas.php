<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Mesa</title>
</head>

<body>
    <form action="searchMesa.php" method="post">
        <input type="number" name="search" placeholder="Buscar por numero" min="1" required>
        <button type="submit">Buscar</button>
    </form>
    <br>
    <a class="img" href="formMesa.php">Crear una nueva mesa</a>
    <br>
    <a href="inicio.php">Volver</a>
</body>

</html>