<?php
session_start();

// Inicializar el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Lógica para añadir productos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto'])) {
    $_SESSION['carrito'][] = $_POST['producto'];
}

// Lógica para vaciar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vaciar'])) {
    session_destroy();
    header("Location: carrito_session.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Tienda Virtual</h2>
    <p>Productos en tu carrito: <strong><?php echo count($_SESSION['carrito']); ?></strong></p>

    <form method="post">
        <button name="producto" value="producto">Añadir Producto</button>
    </form>

    <hr>
    <form method="post">
        <button name="vaciar">Vaciar Carrito</button>
    </form>
</body>
</html>