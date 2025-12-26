<?php
session_start();
require_once 'funciones.php';

if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
} else {
    $mensaje = '';
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
    <h1>Registro de usuario</h1>

    <?php if ($mensaje): ?>
        <p class="error"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <form action="procesar.php" method="POST">
        <p>
            <input type="hidden" name="accion" value="registro">
        </p>
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </p>
        <p>
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>
        </p>
        <p>
            <label for="correo">Correo:</label>
            <input type="text" id="correo" name="correo" required>  
        </p>
        <p>
            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required>
        </p>
        <p>
            <label for="tipo">Tipo de usuario:</label>
            <select id="tipo" name="tipo" required>
                <option value="usuario">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>