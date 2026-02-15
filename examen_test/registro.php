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
    <title>GymFit - Registro</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php if ($msg): ?>
        <div class="form-card">
            <p style="color: red; text-align: center;"><?php echo $msg; ?></p>
        </div>
    <?php endif; ?>
    <div class="form-card">
        <h1>Crear Cuenta</h1>
        <form action="registro_procesar.php" method="POST">

            <label for="nombre">Nombre Completo</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <label for="tipo">Tipo de Usuario</label>
            <select id="tipo" name="tipo" required>
                <option value="normal">Usuario Normal</option>
                <option value="admin">Administrador</option>
            </select>

            <button type="submit">Registrarme</button>
            <p style="text-align:center"><a href="login.php">Ya tengo cuenta</a></p>
        </form>
    </div>
</body>
</html>