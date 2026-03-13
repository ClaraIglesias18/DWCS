<?php
session_start();

if(isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets - Acceso</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h1>Tickets - Acceso</h1>

        <?php if(isset($msg)): ?>
            <p style="color:red"><?= $msg ?></p>
        <?php endif; ?>        
        <form action="procesar.php" method="POST">
            <input type="hidden" name="accion" value="login">
            <div style="margin-bottom: 15px;">
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" id="email" placeholder="ejemplo@correo.com" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="••••••••" required>
            </div>
            <
            <button type="submit" style="width: 100%;">Iniciar Sesión</button>
        </form>

        <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">

        <div style="text-align: center;">
            <p>¿Eres nuevo? <a href="registro.php" style="color: var(--secondary); text-decoration: none; font-weight: bold;">Crea una cuenta aquí</a></p>
        </div>
    </div>
</body>
</html>