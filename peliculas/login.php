<?php
session_start();

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cinefilia List</title>
    <style>
        /* Reutilizamos los mismos estilos para mantener coherencia */
        :root {
            --primary: #e74c3c;
            --dark: #1a1a1a;
            --light: #f4f4f4;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--dark);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .auth-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 380px;
        }

        h2 {
            text-align: center;
            margin-top: 0;
            color: var(--dark);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 0.9em;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
        }

        input:focus {
            border-color: var(--primary);
            outline: none;
        }

        .btn-auth {
            width: 100%;
            background: var(--dark);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-auth:hover {
            background: var(--primary);
        }

        .switch-auth {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
        }

        .switch-auth a {
            color: var(--primary);
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="auth-card">
        <h2>🍿 Bienvenido</h2>
        <?php if (!empty($mensaje)): ?>
            <div style="background: #ffdddd; color: #a94442; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #ebccd1;">
                <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>
        <p style="text-align: center; color: #666; font-size: 0.9em;">Entra para dejar tu reseña</p>

        <form action="procesar.php" method="POST">
            <input type="hidden" name="accion" value="login">

            <div class="form-group">
                <label for="user">Usuario</label>
                <input type="text" id="user" name="user" required>
            </div>

            <div class="form-group">
                <label for="pass">Contraseña</label>
                <input type="password" id="pass" name="pass" required>
            </div>

            <button type="submit" class="btn-auth">Entrar</button>
        </form>

        <div class="switch-auth">
            ¿Eres nuevo? <a href="registro.php">Crea una cuenta</a>
        </div>
    </div>

</body>

</html>