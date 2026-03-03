<?php
session_start();

// Si ya está logueado, mandarlo directamente a la zona privada
if (isset($_SESSION['usuario'])) {
    header("Location: privado.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // Credenciales de prueba (Hardcoded)
    if ($user === "admin" && $pass === "1234") {
        $_SESSION['usuario'] = $user;
        header("Location: privado.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Iniciar Sesión</h2>
    <?php if ($error) echo "<p style='color:red'>$error</p>"; ?>
    <form method="post">
        Usuario: <input type="text" name="user" required><br><br>
        Contraseña: <input type="password" name="pass" required><br><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>