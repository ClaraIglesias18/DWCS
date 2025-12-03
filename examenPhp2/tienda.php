<?php
session_start();
require_once 'funciones.php';

// DEFINIR PRECIOS DE PRODUCTOS
$_SESSION['precios'] = [
    'Libro 1 - PHP básico' => 20.00,
    'Libro 2 - HTML y CSS' => 15.50,
    'Libro 3 - JavaScript para principiantes' => 25.75,
];

//MANTENER LOS DATOS CORRECTOS EN CASO DE ERRORES
$datos_entrada = $_SESSION['datos_entrada'] ?? [];
unset($_SESSION['datos_entrada']);

$mostrar_campo_nombre = true;
$nombre_cliente = '';

// MOSTRAR ERRORES SI EXISTEN Y RESETEAR LA SESION DE ERRORES
if(isset($_SESSION['errores'])) {
    foreach($_SESSION['errores'] as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
    unset($_SESSION['errores']);
}

// SI EXISTE LA COOKIE NOMBRE NO MOSTRAR EL CAMPO
if(isset($_COOKIE['nombre'])) {
    $nombre_cliente = $_COOKIE['nombre'];
    $mostrar_campo_nombre = false;
}

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
        <h2>Bienvenido de nuevo, <?= invertir_nombre($nombre_cliente) ?>.</h2> 
    <?php endif; ?>

    <form action="validaciones.php" method="POST">
        <?php if ($mostrar_campo_nombre): ?>
            <p>
                <label for="nombre">Nombre del cliente:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo ($datos_entrada['nombre'] ?? ''); ?>">
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
            <input type="number" id="cantidad" name="cantidad" value="<?php echo ($datos_entrada['cantidad'] ?? ''); ?>" min="1">
        </p>
        <p>
            <button type="submit" name="accion" value="anadir">Añadir al carrito</button>
        </p>
    </form>

    <p>
        <a href="carrito.php">Ver carrito actual</a>
    </p>
</body>

</html>