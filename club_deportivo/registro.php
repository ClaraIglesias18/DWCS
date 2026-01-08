<?php
session_start();

if (isset($_GET['msg'])) {
    $mensaje = $_GET['msg'];
} else {
    $mensaje = '';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro - Club de Pádel</title>
    <style>
        :root {
            --primary: #2ecc71;
            --dark: #1e272e;
            --light: #f1f2f6;
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
            border-bottom: 3px solid var(--primary);
            display: inline-block;
            width: 100%;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 0.9em;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
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
            margin-top: 10px;
        }

        .btn:hover {
            background: #27ae60;
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
    <?php if ($mensaje): ?>
        <div class="caja-mensaje">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <h2>🎾 Nuevo Jugador</h2>
        <form action="procesar_usuario.php" method="POST">
            <input type="hidden" name="accion" value="registrar">

            <div class="form-group">
                <label>Nombre de Usuario</label>
                <input type="text" name="user" required placeholder="Ej: padel_master">
            </div>

            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="pass" required placeholder="••••••••">
            </div>

            <div class="form-group">
                <label>Tu Nivel</label>
                <select name="nivel">
                    <option value="Principiante">Principiante</option>
                    <option value="Intermedio">Intermedio</option>
                    <option value="Avanzado">Avanzado</option>
                </select>
            </div>

            <button type="submit" class="btn">Crear Cuenta</button>
        </form>
        <div class="link">¿Ya eres socio? <a href="login.php">Entrar</a></div>
    </div>

</body>

</html>