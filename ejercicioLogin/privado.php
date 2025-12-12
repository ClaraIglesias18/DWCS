<?php
session_start();

// 1. Verificación de Autenticación (El pilar de la página privada)
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    // Si la sesión no está activa, redirigir al login
    header('Location: login.php');
    exit();
}

$usuario_actual = $_SESSION['usuario'] ?? 'Usuario';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Privado</title>
</head>
<body>
    <h1>Panel de Control</h1>
    <h2>Bienvenido, <?= htmlspecialchars($usuario_actual) ?></h2>
    
    <p>Este es contenido restringido al que solo puedes acceder si iniciaste sesión correctamente.</p>
    
    <hr>
    
    <p>
        <a href="logout.php">Cerrar Sesión</a>
    </p>
</body>
</html>