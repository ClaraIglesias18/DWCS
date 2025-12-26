<?php
require_once 'funciones.php';

if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
} else {
    $mensaje = '';
}

// Lógica para obtener y mostrar los productos
$productos = [];
$conexion = conectar_db();

if ($conexion) {
    $productos = obtener_productos($conexion);
    cerrar_db($conexion);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos</title>
</head>

<body>

    <h1>Inventario de Productos</h1>

    <?php if ($mensaje): ?>
        <p>
            <?php echo $mensaje; ?>
        </p>
    <?php endif; ?>

    <h2>Añadir Nuevo Producto</h2>
    <form action="procesar_form.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" min="0.01" required><br><br>

        <button type="submit">Guardar Producto</button>
    </form>

    <hr>

    <h2>Productos en Inventario</h2>

    <?php if (is_array($productos) && count($productos) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?php echo $producto['id']; ?></td>
                        <td><?php echo $producto['nombre']; ?></td>
                        <td>$<?php echo $producto['precio']; ?></td>
                        <td><a href="procesar_form.php?accion=borrar&id=<?php echo $producto['id']; ?>">
                                Borrar
                            </a>
                            <a href="editar.php?accion=editar&id=<?php echo htmlspecialchars($producto['id']); ?>">
                                Editar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay productos en el inventario.</p>
    <?php endif; ?>

</body>

</html>