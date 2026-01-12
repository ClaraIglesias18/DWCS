<?php
session_start();
// Obtenemos el mensaje de la sesión si existe
if(isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
} else {
    $msg = "Aquí aparecerá el mensaje de lo que se realizó.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla de Registro - Sistema Escolar</title>
    <style>
        /* 1. CONFIGURACIÓN GENERAL Y CENTRADO */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            display: flex;
            justify-content: center; /* Centra horizontalmente */
            align-items: center;     /* Centra verticalmente */
            min-height: 100vh;
        }

        /* 2. CONTENEDOR MAESTRO (Apila elementos de arriba a abajo) */
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
            max-width: 350px; /* Misma anchura que el formulario */
            padding: 15px;
            margin-bottom: 20px; /* Separación con el formulario */
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #d4edda; /* Verde por defecto (éxito) */
            color: #155724;
            border: 1px solid #c3e6cb;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        /* Clase extra para cuando sea un error (se añade manualmente o con JS) */
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

        /* 4. ESTILO DEL FORMULARIO */
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
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            color: #555;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box; /* Evita que el padding ensanche el input */
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
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="main-wrapper">

        <div class="message-box" id="msg-alert">
            <span><?= $msg ?></span>
            <button class="close-btn" onclick="document.getElementById('msg-alert').style.display='none'">&times;</button>
        </div>

        <div class="form-container">
            <h2>Registro</h2>
            <form action="procesar_usuarios.php" method="POST">

                <input type="hidden" name="accion" value="registrar">
                <div class="input-group">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre completo" required>
                </div>

                <div class="input-group">
                    <label for="username">Nombre de Usuario</label>
                    <input type="text" id="username" name="username" placeholder="Usuario" required>
                </div>

                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="********" required>
                </div>

                <div class="input-group">
                    <label for="rol">Tipo de Usuario</label>
                    <select id="rol" name="rol">
                        <option value="normal">Usuario Normal</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>

                <button type="submit">Guardar Registro</button>
            </form>
        </div>

    </div>

</body>
</html>