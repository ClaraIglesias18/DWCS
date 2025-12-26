<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] != 'admin') {
    $mensaje = "Error de permisos";
    header("Location: login.php?mensaje=". $mensaje);
    exit();
}
echo "<h1>Bienvenido Administrador: " . $_SESSION['nombre'] . "</h1>";
echo '<p><a href="logout.php">Cerrar sesión</a></p>';
?>