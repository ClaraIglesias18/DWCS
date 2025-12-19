<?php
// editar.php - Página dedicada a la edición de un solo producto.

require_once 'funciones.php';

$producto_a_editar = null;
$mensaje_error = '';

// --- 1. Obtener el ID del producto a editar de la URL (GET) ---
if (!isset($_GET['id']) || (int)$_GET['id'] <= 0) {
    // Si no hay ID válido, redirigir
    header("Location: index.php?mensaje=" . urlencode("ERROR: ID de producto no especificado o inválido."));
    exit();
}

$id_edicion = (int)$_GET['id'];

// --- 2. Cargar el Producto desde la Base de Datos ---
$conexion = conectar_db();

if ($conexion) {
    $producto_a_editar = obtener_producto_por_id($conexion, $id_edicion);
    cerrar_db($conexion);
} else {
    $mensaje_error = "Error al conectar con la base de datos para cargar el producto.";
}

// --- 3. Verificación de Existencia ---
if (!$producto_a_editar) {
    header("Location: index.php?mensaje=" . urlencode("ERROR: El producto con ID $id_edicion no existe."));
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto: <?php echo htmlspecialchars($producto_a_editar['nombre']); ?></title>
</head>
<body>

    <h1>Editar Producto: <?php echo htmlspecialchars($producto_a_editar['nombre']); ?></h1>
    
    <?php if (!empty($mensaje_error)): ?>
        <p style="color: red;"><?php echo $mensaje_error; ?></p>
    <?php endif; ?>

    <form action="procesar_form.php" method="POST">
        
        <input type="hidden" name="accion" value="actualizar">
        
        <input type="hidden" name="id_edicion" value="<?php echo htmlspecialchars($producto_a_editar['id']); ?>">
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required 
               value="<?php echo htmlspecialchars($producto_a_editar['nombre']); ?>"><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" min="0.01" required 
               value="<?php echo htmlspecialchars($producto_a_editar['precio']); ?>"><br><br>

        <button type="submit">Guardar Cambios</button>
        
        <a href="index.php">Cancelar y Volver a la Lista</a>
    </form>

</body>
</html>