<?php
session_start();
require_once 'funciones.php';

// Definición de las claves de producto largas para la tabla (si los datos de sesión son las claves cortas)
$nombres_completos = [
    'Libro 1' => 'Libro 1 PHP básico',
    'Libro 2' => 'Libro 2 HTML y CSS',
    'Libro 3' => 'Libro 3 JavaScript para principiantes',
];

// Comprobar si la acción es añadir producto (POST) o solo ver carrito (GET/enlace)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['accion'] ?? '') === 'anadir') {
    // --- Lógica de envío de formulario (Añadir al carrito) [cite: 25] ---
    
    $nombre = trim($_POST['nombre'] ?? '');
    $producto = $_POST['producto'] ?? '';
    $cantidad = (int) ($_POST['cantidad'] ?? 0);
    $errores = [];

    // 1. Validación de Nombre
    $existe_cookie = isset($_COOKIE['nombre_cliente']);
    if (!$existe_cookie && !validar_no_vacio($nombre)) {
        // Nombre no puede ser vacío si NO existe la cookie [cite: 27]
        $errores[] = "El nombre del cliente no puede estar vacío la primera vez.";
    } else {
        // Si no existe la cookie, se guarda. Caduca en 90 segundos (1 minuto y medio) [cite: 2, 28]
        setcookie('nombre_cliente', $nombre, time() + 90, "/");
        // Asegurar que el nombre del cliente esté disponible para el mensaje de bienvenida
        $_COOKIE['nombre_cliente'] = $nombre;
    }

    // 2. Validación de Producto [cite: 29]
    if (!validar_no_vacio($producto)) {
        $errores[] = "Debe seleccionar un producto.";
    }

    // 3. Validación de Cantidad [cite: 30]
    if (!validar_multiplo_tres($cantidad)) {
        $errores[] = "La cantidad debe ser un múltiplo de 3 (3, 6, 9, etc.).";
    }

    // Si hay errores, volver a tienda.php y mostrar los mensajes [cite: 31]
    if (!empty($errores)) {
        $_SESSION['errores'] = $errores;
        header('Location: tienda.php');
        exit;
    }

    // Si todo es válido: Almacenar/Sumar la cantidad en la variable de sesión [cite: 32]
    if (isset($_SESSION['carrito'][$producto])) {
        $_SESSION['carrito'][$producto] += $cantidad;
    } else {
        $_SESSION['carrito'][$producto] = $cantidad;
    }
    
    // Si se añade un producto con éxito, se muestra el carrito (el resto del script lo hace)
} 

// Obtener datos del carrito para la visualización [cite: 37]
$carrito = $_SESSION['carrito'] ?? [];
$precios = $_SESSION['precios'] ?? [];

// Si no hay productos en el carrito
if (empty($carrito)) {
    $carrito_vacio = true; // [cite: 36]
} else {
    $carrito_vacio = false;
    // Calcular el precio total
    $precio_total = calcular_precio_total($carrito, $precios); // [cite: 34, 50]
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

    <?php 
    $nombre_cookie_valido = $_COOKIE['nombre_cliente'] ?? null;
    if ($nombre_cookie_valido): ?>
        <p>Hola, <?= invertir_nombre($nombre_cookie_valido) ?></p> <?php endif; ?>

    <?php if ($carrito_vacio): ?>
        <p>El carrito está vacío.</p>
        <p><a href="tienda.php">Ir a la tienda</a></p> <?php else: ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unitario (€)</th>
                <th>Subtotal (€)</th>
            </tr>
            
            <?php foreach ($carrito as $producto_clave => $cantidad): 
                $nombre_producto = $nombres_completos[$producto_clave] ?? $producto_clave;
                $precio_unitario = $precios[$producto_clave] ?? 0;
                $subtotal = $cantidad * $precio_unitario; // [cite: 33]
            ?>
                <tr>
                    <td><?= $nombre_producto ?></td>
                    <td><?= $cantidad ?></td>
                    <td><?= number_format($precio_unitario, 2, ',', '.') ?></td>
                    <td><?= number_format($subtotal, 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong><?= number_format($precio_total, 2, ',', '.') ?> €</strong></td>
            </tr>
        </table>

        <p>
            <a href="tienda.php">Seguir comprando</a> | 
            <a href="reset.php">Vaciar carrito</a>
        </p>
    <?php endif; ?>
</body>
</html>