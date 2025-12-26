<?php
session_start();

if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
} else {
    $mensaje = '';
}

// 1. Verificamos si existe la variable de sesión que identifica al usuario
if (isset($_SESSION['usuario_id']) && isset($_SESSION['tipo'])) {
    
    // 2. Redirigimos según el tipo que ya tenemos guardado en la sesión
    switch ($_SESSION['tipo']) {
        case 'admin':
            header("Location: admin.php");
            break;
        case 'usuario':
            header("Location: perfil.php");
            break;
        default:
            // Por si acaso hay un tipo no definido, lo mandamos a una página genérica
            header("Location: login.php");
            break;
    }
    exit(); 
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <style>
        .error { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Iniciar Sesión</h1>

    <?php if ($mensaje): ?>
        <p class="error"><?= $mensaje ?></p>
    <?php endif; ?>

    <form action="procesar.php" method="POST">
        <p>
            <label for="correo">Correo:</label>
            <input type="text" id="correo" name="correo" required>
        </p>
        <p>
            <label for="contraseña">Contraseña (1234):</label>
            <input type="password" id="contraseña" name="contraseña" required>
        </p>
        <button type="submit">Entrar</button>
    </form>
    <a href="registro.php">¿No tienes cuenta? Regístrate aquí</a>
</body>
</html>