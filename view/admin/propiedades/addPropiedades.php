<!DOCTYPE html>
<html>
<head>
    <title>Agregar Propiedad</title>
    <link rel="stylesheet" type="text/css" href="public/css/styles.css">
</head>
<body>
    <h1>Agregar Propiedad</h1>
    <form action="index.php?controller=property&action=add" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required></textarea>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" required>
        <button type="submit">Agregar</button>
    </form>
</body>
</html>
