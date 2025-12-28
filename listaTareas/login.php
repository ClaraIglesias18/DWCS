<?php
session_start();

if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
} else {
    $mensaje = '';
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso al Gestor de Tareas</title>
    <style>
        :root {
            --primary: #4a90e2;
            --secondary: #6c757d;
            --dark: #2c3e50;
            --light: #f4f7f6;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 400px;
            width: 100%;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: var(--dark);
        }

        p {
            color: var(--secondary);
            margin-bottom: 30px;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 0.85rem;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: var(--primary);
        }

        button {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
            margin-top: 10px;
            transition: background 0.3s;
        }

        button:hover {
            background: #357abd;
        }

        .footer-links {
            margin-top: 25px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .btn-register {
            text-decoration: none;
            color: var(--primary);
            font-size: 0.9em;
            font-weight: bold;
        }

        .btn-register:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>🔑 Acceso</h1>

        <?php if (!empty($mensaje)): ?>
            <div class="alert"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <p>Introduce tus credenciales para continuar</p>

        <form action="procesar.php" method="POST">
            <input type="hidden" name="accion" value="login">

            <div class="form-group">
                <label for="user">Nombre de usuario</label>
                <input type="text" id="usuario" name="usuario" placeholder="Ej: pablo_dev" required>
            </div>

            <div class="form-group">
                <label for="pass">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit">Entrar al Gestor</button>
        </form>

        <div class="footer-links">
            <a href="registro.php" class="btn-register">¿No tienes cuenta? Regístrate aquí</a>
        </div>
    </div>

</body>

</html>