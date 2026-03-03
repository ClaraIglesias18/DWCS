<?php
session_start();

// SEGURIDAD: Si no hay sesión, redirigir al login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['usuario']; ?></h1>
    <p>Este contenido es solo para usuarios registrados.</p>
    <hr>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>