<?php
// =======================================================
// ARCHIVO: bienvenida.php
// MISIÓN: Mostrar datos personalizados con color.
// =======================================================

session_start();
include 'funciones.php'; // Incluimos para usar la función de color

// 1. SEGURIDAD: Si no tienes 'usuario_actual', te echa.
if (!isset($_SESSION['usuario_actual'])) {
    header("Location: index.php");
    exit();
}

// 2. OBTENER Y TRADUCIR COLOR
$colorEspanol = $_SESSION['color_actual'];
$colorCSS = obtenerColorCSS($colorEspanol); 

// 3. MENSAJE DINÁMICO
$mensajeColor = "";
if ($colorEspanol == 'Negro') {
    $mensajeColor = "No tiene color favorito."; // Texto solicitado para color Negro
} else {
    $mensajeColor = "Tu color favorito es: " . $colorEspanol;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['usuario_actual']; ?></h1>
    
    <p style="color: <?php echo $colorCSS; ?>;">
        <strong><?php echo $mensajeColor; ?></strong>
    </p>
    
    <h3>Opciones</h3>
    <a href="historial.php">Ver Historial</a>
    <br><br>

    <form action="index.php" method="POST">
        <input type="submit" name="cerrar_sesion" value="Cerrar Sesión" style="color: red;">
    </form>
</body>
</html>