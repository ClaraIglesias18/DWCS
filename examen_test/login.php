<?php
session_start();
if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
} else {
    $msg = "";
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>GymFit - Acceso</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <?php if ($msg): ?>
        <div class="form-card">
            <p style="color: red; text-align: center;"><?php echo $msg; ?></p>
        </div>
    <?php endif; ?>

    <div class="form-card">
        <h1>Entrar</h1>
        <form action="login_procesar.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Iniciar Sesión</button>
            <p style="text-align:center">¿Nuevo? <a href="registro.php">Regístrate</a></p>
        </form>
    </div>
</body>

</html>