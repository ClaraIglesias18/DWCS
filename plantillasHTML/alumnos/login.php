<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Escolar</title>
    <style>
        /* 1. CONFIGURACIÓN GENERAL Y CENTRADO */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* 2. CONTENEDOR MAESTRO (Apila elementos verticalmente) */
        .main-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 20px;
        }

        /* 3. ESTILO DEL MENSAJE DE ESTADO */
        .message-box {
            width: 100%;
            max-width: 350px;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #cfe2ff; /* Azul claro para información */
            color: #084298;
            border: 1px solid #b6d4fe;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        /* Clase para errores de login */
        .message-error {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            color: inherit;
        }

        /* 4. ESTILO DEL FORMULARIO DE LOGIN */
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 350px;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            margin-top: 0;
            color: #333;
            font-size: 24px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .footer-links {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
        }

        .footer-links a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="main-wrapper">

        <div class="message-box" id="msg-alert">
            <span>Introduce tus credenciales para acceder.</span>
            <button class="close-btn" onclick="document.getElementById('msg-alert').style.display='none'">&times;</button>
        </div>

        <div class="form-container">
            <h2>Iniciar Sesión</h2>
            <form action="#" method="POST">
                <div class="input-group">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username" placeholder="Nombre de usuario" required>
                </div>

                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Tu contraseña" required>
                </div>

                <button type="submit">Entrar</button>
            </form>

            <div class="footer-links">
                ¿No tienes cuenta? <a href="registro.html">Regístrate aquí</a>
            </div>
        </div>

    </div>

</body>
</html>