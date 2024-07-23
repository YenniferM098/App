<!DOCTYPE html>
<html>
<head>
    <title>Lista de Propiedades</title>
    <link rel="stylesheet" type="text/css" href="public/css/styles.css">
</head>
<body>
    <h1>Lista de Propiedades</h1>
    <a href="index.php?controller=property&action=add">Agregar Propiedad</a>
    <table>
        <tr>
            <th>Título</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($properties as $property) { ?>
            <tr>
                <td><?php echo $property['titulo']; ?></td>
                <td><?php echo $property['descripcion']; ?></td>
                <td><?php echo $property['precio']; ?></td>
                <td>
                    <a href="index.php?controller=property&action=edit&id=<?php echo $property['id']; ?>">Editar</a>
                    <a href="index.php?controller=property&action=delete&id=<?php echo $property['id']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
