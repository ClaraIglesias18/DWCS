<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <div class="form-card">
        <h1>Crear Cuenta</h1>
        <form action="registro_procesar.php" method="POST">

            <label for="nombre">Nombre Completo</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Registrarme</button>
            <p style="text-align:center"><a href="login.php">Ya tengo cuenta</a></p>
        </form>
    </div>
</body>
</html>