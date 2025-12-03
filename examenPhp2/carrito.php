<?php 
session_start();
include_once 'funciones.php';

//COMPROBAMOS SI EXISTE ARRAY DE CARRITO Y SI NO LO CREAMOS VACIO
if(!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carrito de la compra</title>
</head>

<body>
    <h1>Carrito de la compra</h1>
    <?php if (isset($_COOKIE['nombre'])): ?>
        <p>Hola, <?= invertir_nombre($_COOKIE['nombre']) ?></p>
    <?php endif; ?>
    <?php if(empty($_SESSION['carrito'])): ?>
        <p>El carrito está vacío.</p>
    <?php endif; ?>
        <p><a href="tienda.php">Ir a la tienda</a>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unitario (€)</th>
                <th>Subtotal (€)</th>
            </tr>
            <?php foreach ($_SESSION['carrito'] as $producto => $cantidad) : ?>
            <tr>
                <td><?php echo $producto ?></td>
                <td><?php echo $cantidad ?></td>
                <td><?php echo $_SESSION['precios'][$producto]?></td>
                <td><?php echo calcular_precio_por_producto($cantidad, $_SESSION['precios'][$producto])?></td>
            </tr>
            <?php endforeach; ?>

            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong><?php echo calcular_precio_total($_SESSION['carrito'], $_SESSION['precios'])?></strong></td>
            </tr>
        </table>

        <p>
            <a href="tienda.php">Seguir comprando</a> |
            <a href="reset.php">Vaciar carrito</a>
        </p>
</body>

</html>