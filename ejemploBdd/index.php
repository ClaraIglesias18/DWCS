<?php
// 1. Incluir el archivo de funciones para tener la lógica disponible
require_once 'funciones.php';

$mensaje = '';

// 2. Lógica para añadir un nuevo producto 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que los datos necesarios existen
    if (isset($_POST['nombre']) && isset($_POST['precio'])) {
        $nombre = trim($_POST['nombre']);
        $precio = (float)$_POST['precio'];

        // Solo intentar insertar si hay datos
        if (!empty($nombre) && $precio > 0) {
            $conexion = conectar_db();

            if ($conexion) {
                if (insertar_producto($conexion, $nombre, $precio)) {
                    $mensaje = "¡Producto **$nombre** añadido con éxito!";
                } else {
                    $mensaje = "ERROR: No se pudo añadir el producto.";
                }
                cerrar_db($conexion); // Cerramos la conexión después de usarla
            }
        } else {
            $mensaje = "ERROR: El nombre y el precio deben ser válidos.";
        }
    }
}

// 2b. Lógica para borrar un producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'borrar') {
    if (isset($_POST['id'])) {
        $id_a_borrar = (int)$_POST['id'];

        if ($id_a_borrar > 0) {
            $conexion = conectar_db();

            if ($conexion) {
                if (borrar_producto($conexion, $id_a_borrar)) {
                    $mensaje = "Producto con ID $id_a_borrar eliminado";
                } else {
                    $mensaje = "ERROR: No se pudo eliminar el producto o no se encontro.";
                }
                cerrar_db($conexion);
            }
        } else {
            $mensaje = "ERROR: ID de producto invalido para borrar.";
        }
    }
}

// 3. Lógica para obtener y mostrar los productos
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
    <form action="index.php" method="POST">
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
                        <td>
                            <form action="index.php" method="POST">
                                <input type="hidden" name="accion" value="borrar">

                                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">

                                <button type="submit" style="color: red;">Borrar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($productos === false): ?>
        <p>No se pudieron cargar los productos de la base de datos.</p>
    <?php else: ?>
        <p>No hay productos en el inventario.</p>
    <?php endif; ?>

</body>

</html>