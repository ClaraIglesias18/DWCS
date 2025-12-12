<?php
session_start();
require_once 'funciones.php';

if (!isset($_SESSION['precios'])) {
    $_SESSION['precios'] = [
        'Libro 1 - PHP básico' => 10.00,
        'Libro 2 - HTML y CSS' => 15.50,
        'Libro 3 - JavaScript para principiantes' => 20.00,
    ];
}

// Comprobar si existe la cookie del nombre del cliente
$nombre_cliente = $_COOKIE['nombre_cliente'] ?? null;
$mostrar_nombre_campo = empty($nombre_cliente);

// Obtener mensajes de error de la sesión (si vienen de carrito.php)
$errores = $_SESSION['errores'] ?? [];
// Limpiar los errores de la sesión una vez mostrados
unset($_SESSION['errores']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tienda de libros - Examen PHP</title>
</head>

<body>
    <h1>Tienda de libros</h1>

    <?php if ($nombre_cliente): ?>
        <h2>Hola, <?= invertir_nombre($nombre_cliente) ?>.</h2> <?php endif; ?>

    <?php if (!empty($errores)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?= $error ?></li> 
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="carrito.php" method="POST">

        <?php if ($mostrar_nombre_campo): ?>
            <p>
                <label for="nombre">Nombre del cliente:</label>
                <input type="text" id="nombre" name="nombre">
            </p>
        <?php endif; ?>

        <p>
            <label for="producto">Producto:</label>
            <select id="producto" name="producto">
                <option value="">-- Selecciona un libro --</option>
                <option>Libro 1 - PHP básico</option>
                <option>Libro 2 - HTML y CSS</option>
                <option>Libro 3 - JavaScript para principiantes</option>
            </select>
        </p>

        <p>
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" value="1" min="1">
        </p>
        <p>
            <button type="submit" name="accion" value="anadir">Añadir al carrito</button>
        </p>
    </form>

    <p>
        <a href="carrito.php?accion=ver">Ver carrito actual</a>
    </p>
</body>

</html>