<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - Gestor de Tareas</title>
    <style>
        :root {
            --primary: #27ae60; /* Verde para diferenciar el registro del login */
            --primary-hover: #219150;
            --dark: #2c3e50;
            --light: #f4f7f6;
            --danger: #e74c3c;
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
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
        }
        h2 { text-align: center; color: var(--dark); margin-bottom: 25px; }
        
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; font-size: 0.85rem; }
        
        input[type="text"], input[type="password"] {
            width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; box-sizing: border-box; outline: none; transition: border-color 0.3s;
        }
        input[type="text"]:focus, input[type="password"]:focus { border-color: var(--primary); }

        .mensaje-alerta { 
            padding: 12px; 
            border-radius: 6px; 
            color: white; 
            font-size: 0.9em; 
            margin-bottom: 20px; 
            text-align: center;
            background-color: var(--danger); /* Ejemplo de color de alerta */
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
        }
        button:hover { background: var(--primary-hover); }
        
        .footer { 
            margin-top: 25px; 
            text-align: center; 
            font-size: 0.9em; 
            border-top: 1px solid #eee; 
            padding-top: 20px; 
        }
        .footer a { color: #4a90e2; text-decoration: none; font-weight: bold; }
        .footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="container">
        <h2>Crear Cuenta</h2>

        <?php if (!empty($mensaje)): ?>
            <div class="alert"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <form action="procesar.php" method="POST">
            <input type="hidden" name="accion" value="registrar">

            <div class="form-group">
                <label for="user">Nombre de Usuario</label>
                <input type="text" name="usuario" id="usuario" required placeholder="Ej: juan_perez">
            </div>

            <div class="form-group">
                <label for="pass">Contraseña</label>
                <input type="password" name="password" id="password" required placeholder="mínimo 6 caracteres">
            </div>

            <button type="submit">Registrarse</button>
        </form>

        <div class="footer">
            ¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a>
        </div>
    </div>

</body>
</html>