<?php
session_start();

if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
} else {
    $mensaje = '';
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro - EcoSwap</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <nav>
        <a href="index.php" class="logo">EcoSwap</a>
        <div class="nav-links">
            <a href="index.php">Volver al catálogo</a>
        </div>
    </nav>

    <div class="container" style="max-width: 500px;">
        <form action="auth_procesar.php?action=registro" method="POST">
            <h2>Crear una cuenta</h2>
            <p>Únete para empezar a vender y guardar tus favoritos.</p>

            <?php if (isset($mensaje)): ?>
                <p><?= $mensaje ?></p>
            <?php endif; ?>

            <label for="nombre">Nombre completo</label>
            <input type="text" name="nombre" id="nombre" required placeholder="Tu nombre">

            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" required placeholder="email@ejemplo.com">

            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required placeholder="Mínimo 6 caracteres">

            <button type="submit" class="btn btn-vender" style="width: 100%; padding: 12px; font-size: 1rem;">Registrarse</button>

            <p style="text-align: center; margin-top: 20px;">
                ¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a>
            </p>
        </form>
    </div>
</body>

</html>