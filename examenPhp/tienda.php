<?php
session_start();

require_once "funciones.php";

// Crear variables de sesión con los precios
$_SESSION["precio1"] = 10;
$_SESSION["precio2"] = 15.50;
$_SESSION["precio3"] = 20;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda de libros - Ejemplo Carrito</title>
</head>
<body>
    <h1>Tienda de libros</h1>
    
    <form action="carrito.php" method="POST">
        <!-- SOLO aparece si NO hay cookie -->
        <?php if (!isset($_COOKIE["nombre"])): ?>
        <p>
            <label for="nombre">Nombre del cliente:</label>
            <input type="text" name="nombre">
        </p>
        <?php else: ?>
        <p>Hola, <?php echo htmlspecialchars($_COOKIE["nombre"]); ?></p>
        <!-- Enviar nombre vacío porque carrito.php lo requiere -->
        <input type="hidden" name="nombre" value="">
        <?php endif; ?>

        <p>
            <label for="producto">Producto:</label>
            <select name="producto">
                <option value="">-- Selecciona un libro --</option>
                <option value="Libro 1 - PHP básico">Libro 1 - PHP básico</option>
                <option value="Libro 2 - HTML y CSS">Libro 2 - HTML y CSS</option>
                <option value="Libro 3 - JavaScript para principiantes">Libro 3 - JavaScript para principiantes</option>
            </select>
        </p>

        <p>
            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad">
        </p>

        <p>
            <button type="submit">Añadir al carrito</button>
        </p>
    </form>

    <p>
        <a href="carrito.php">Ver carrito actual</a>
    </p>
</body>
</html>
