<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styleAdmin.css">
    <title>Administrar Mesa</title>
</head>

<body>
    <section class="container">
        <form action="Actions/searchMesa.php" method="post">
            <img src="../images/log.jpg" alt="logo"></img>
            <input type="text" name="search" placeholder="Buscar mesa" maxlength="10" required>
            <button type="submit">Buscar</button>
        </form>
        <br>
        <div class="botones">
            <a class="img" href="Forms/formMesa.php">Crear una nueva mesa</a>
            <br>
            <a href="inicio.php">Volver</a>
        </div>
    </section>
</body>

</html>