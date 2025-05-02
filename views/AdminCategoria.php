<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styleAdmin.css">
    <title>Administrar Categoria</title>
</head>

<body>
    <form action="Actions/searchCategoria.php" method="post">
        <input type="text" name="search" placeholder="Buscar por nombre" required>
        <button type="submit">Buscar</button>
    </form>
    <br>
    <div class="botones">
        <a class="img" href="Forms/formCat.php">Crear una nueva Categoria</a>
        <br>
        <a href="inicio.php">Volver</a>
    </div>
</body>

</html>