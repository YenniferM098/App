<!DOCTYPE html>
<html>
<head>
    <title>Editar Propiedad</title>
    <link rel="stylesheet" type="text/css" href="public/css/styles.css">
</head>
<body>
    <h1>Editar Propiedad</h1>
    <form action="index.php?controller=property&action=edit&id=<?php echo $propertyData['id']; ?>" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" value="<?php echo $propertyData['titulo']; ?>" required>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required><?php echo $propertyData['descripcion']; ?></textarea>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" value="<?php echo $propertyData['precio']; ?>" required>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
