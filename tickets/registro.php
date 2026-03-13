<?php
session_start();

if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets FixIt - Registro</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="container" style="max-width: 450px; margin-top: 50px;">
        <h1>Crear Cuenta</h1>
        <?php if (isset($msg)): ?>
            <p style="color:red"><?= $msg ?></p>
        <?php endif; ?>
        <p style="text-align: center; color: #666;">Únete al sistema de gestión de incidencias</p>

        <form action="procesar.php" method="POST">
            <input type="hidden" name="accion" value="registrar">
            <div style="margin-bottom: 15px;">
                <label for="nombre">Nombre Completo</label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu nombre y apellidos" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" id="email" placeholder="ejemplo@correo.com" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Mínimo 6 caracteres" required>
            </div>

            <div style="margin-bottom: 20px;">
                <label for="rol">Tipo de Perfil</label>
                <select name="rol" id="rol" required>
                    <option value="" disabled selected>Selecciona tu rol...</option>
                    <option value="empleado">Soy Empleado (Reporto problemas)</option>
                    <option value="tecnico">Soy Técnico (Resuelvo problemas)</option>
                </select>
                <small style="color: #888; display: block; margin-top: 5px;">
                    El rol determinará tus permisos en la plataforma.
                </small>
            </div>

            <button type="submit" style="width: 100%; background: var(--success);">Finalizar Registro</button>
        </form>

        <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">

        <div style="text-align: center;">
            <p>¿Ya tienes cuenta? <a href="index.php" style="color: var(--secondary); text-decoration: none; font-weight: bold;">Inicia sesión</a></p>
        </div>
    </div>
</body>

</html>