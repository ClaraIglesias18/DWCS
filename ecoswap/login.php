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
    <title>Login - EcoSwap</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <nav>
        <a href="index.php" class="logo">EcoSwap</a>
        <div class="nav-links">
            <a href="index.php">Volver al catálogo</a>
        </div>
    </nav>
    <div class="container" style="max-width: 400px; margin-top: 50px;">

        <form action="auth_procesar.php?action=login" method="POST">
            <h2 style="text-align: center;">Identifícate</h2>
            <?php if (isset($mensaje)): ?>
                <p><?= $mensaje ?></p>
            <?php endif; ?>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required>

            <button type="submit" class="btn btn-vender" style="width: 100%; padding: 12px; font-size: 1rem;">Entrar</button>

            <p style="text-align: center; margin-top: 20px;">
                ¿Aún no eres miembro? <a href="registro.php">Regístrate gratis</a>
            </p>
        </form>
    </div>
</body>

</html>