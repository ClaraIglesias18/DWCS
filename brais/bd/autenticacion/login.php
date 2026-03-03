<?php
session_start();

// Si ya está logueado, mandarlo directamente a la zona privada
if (isset($_SESSION['usuario'])) {
    header("Location: privado.php");
    exit;
}

if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
} else {
    $msg = "";
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Iniciar Sesión</h2>
    <?php if ($msg) echo "<p style='color:red'>$msg</p>"; ?>
    <form method="post" action="login_procesar.php">
        Usuario: <input type="text" name="usuario" required><br><br>
        Contraseña: <input type="password" name="password" required><br><br>
        <button type="submit">Entrar</button>
    </form>
    <a href="registro.php">¿No tienes cuenta? Regístrate aquí</a>
</body>
</html>