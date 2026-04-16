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
    <title>Login - Concesionario</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 350px; }
        h2 { margin-top: 0; color: #2c3e50; text-align: center; margin-bottom: 25px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #34495e; }
        input { width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-auth { background: #27ae60; color: white; border: none; width: 100%; padding: 12px; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold; }
        .btn-auth:hover { background: #219150; }
        .footer-link { display: block; text-align: center; margin-top: 20px; color: #7f8c8d; text-decoration: none; font-size: 14px; }
        .footer-link:hover { color: #27ae60; }
    </style>
</head>
<body>

<div class="card">
    <h2>Iniciar Sesión</h2>
    <?php if(isset($msg)): ?>
        <p style="color:red"><?= $msg ?></p>
    <?php endif; ?>  
    <form action="procesar_usuario.php" method="POST">

        <input type="hidden" name="accion" value="login">

        <label>Email</label>
        <input type="text" name="email" placeholder="Tu usuario" required>

        <label>Contraseña</label>
        <input type="password" name="password" placeholder="********" required>

        <button type="submit" class="btn-auth">Entrar al Sistema</button>
        <a href="registro.php" class="footer-link">¿No tienes cuenta? Regístrate aquí</a>
    </form>
</div>

</body>
</html>