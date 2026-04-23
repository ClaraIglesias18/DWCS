<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Acceso Socios - Club de Pádel</title>
    <style>
        :root {
            --primary: #3498db;
            --dark: #1e272e;
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

        .card {
            background: white;
            padding: 35px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            color: var(--dark);
            margin-bottom: 25px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            margin-bottom: 15px;
        }

        .btn {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background: #2980b9;
        }

        .link {
            text-align: center;
            margin-top: 15px;
            font-size: 0.85em;
        }

        .link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: bold;
        }

        .caja-mensaje {
            padding: 15px;
            margin: 15px 0;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            border-radius: 5px;
            color: #333;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="card">
        <h2 style="border-bottom: 3px solid var(--primary); padding-bottom: 10px;">🏆 Acceso Socios</h2>
        <form action="procesar_usuario.php" method="POST">

            <input type="text" name="user" placeholder="Usuario" required>
            <input type="password" name="pass" placeholder="Contraseña" required>

            <button type="submit" class="btn">Iniciar Sesión</button>
        </form>
        <div class="link">¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></div>
    </div>

</body>

</html>