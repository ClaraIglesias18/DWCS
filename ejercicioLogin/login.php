<?php
session_start();

// Si ya está autenticado, redirigir al panel inmediatamente
if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
    header('Location: privado.php');
    exit();
}

// Recuperar el nombre de usuario de la cookie "recuerdame" si existe
$usuario_recordado = $_COOKIE['recuerdame'] ?? '';

// Recuperar y limpiar el mensaje de error de la sesión
$error_mensaje = $_SESSION['error_login'] ?? '';
unset($_SESSION['error_login']);
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

    <?php if ($error_mensaje): ?>
        <p class="error"><?= htmlspecialchars($error_mensaje) ?></p>
    <?php endif; ?>

    <form action="verificar.php" method="POST">
        <p>
            <label for="usuario">Usuario (admin):</label>
            <input type="text" id="usuario" name="usuario" 
                   value="<?= htmlspecialchars($usuario_recordado) ?>" required>
        </p>
        <p>
            <label for="password">Contraseña (1234):</label>
            <input type="password" id="password" name="password" required>
        </p>
        <p>
            <input type="checkbox" id="recordarme" name="recordarme">
            <label for="recordarme">Recordarme (7 días)</label>
        </p>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>