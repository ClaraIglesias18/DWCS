<?php
session_start();
require_once('db.php');
require_once('funciones.php');

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensaje'] = "Para ver tus artículos debes iniciar sesion";
    header('Location: index.php');
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$productos = obtener_productos_por_usuario($conexion, $id_usuario);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Artículos - EcoSwap</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <nav>
        <a href="index.php" class="logo">EcoSwap</a>
        <div class="nav-links">
            <a href="index.php">Catálogo</a>
            <a href="subir_articulo.php" class="btn-vender" style="color:white">+ Nuevo Artículo</a>
            <a href="logout.php">Salir</a>
        </div>
    </nav>

    <div class="container">
        <h1>Mis Artículos a la venta</h1>
        <table>
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($productos)): ?>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><img src="" width="50" style="border-radius:4px;"></td>
                            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td><?php echo $producto['precio']; ?>€</td>
                            <td><span class="badge"></span></td>
                            <td>
                                <a href="subir_articulo.php?id=<?php echo $producto['id']; ?>" class="btn" style="background:var(--secondary); color:white;">Editar</a>
                                <a href="articulo_procesar.php?id=<?php echo $producto['id']; ?>" class="btn" style="background:var(--danger); color:white;">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">No tienes artículos a la venta</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>