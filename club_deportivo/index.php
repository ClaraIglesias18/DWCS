<?php
session_start();
require_once 'db.php';
require_once 'funciones_pistas.php';

if (isset($_GET['msg'])) {
    $mensaje = $_GET['msg'];
} else {
    $mensaje = '';
}

// Obtenemos el listado real de la base de datos
$pistas = obtener_todas_las_pistas($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Club Deportivo - Reserva de Pistas</title>
    <style>
        :root {
            --primary: #3498db;
            --success: #2ecc71;
            --dark: #2c3e50;
            --light: #f4f7f6;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--light);
            padding: 20px;
        }

        .grid-pistas {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .pista-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border-top: 4px solid var(--primary);
        }

        .pista-card h3 {
            margin: 0 0 10px 0;
            color: var(--dark);
        }

        .pista-info {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 15px;
        }

        .precio {
            font-weight: bold;
            color: var(--dark);
            display: block;
            margin-top: 5px;
        }

        .btn-reservar {
            display: block;
            background: var(--primary);
            color: white;
            text-decoration: none;
            text-align: center;
            padding: 10px;
            border-radius: 6px;
            font-weight: bold;
        }

        .btn-reservar:hover {
            background: #2980b9;
        }

        .user-nav {
            background: white;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

    <div class="user-nav">
        <div>
            <?php if (isset($_SESSION['username'])): ?>
                Bienvenido, <strong>@<?php echo $_SESSION['username']; ?></strong>
                <span style="font-size: 0.8em; background: #eee; padding: 3px 8px; border-radius: 10px;">
                    Nivel: <?php echo $_SESSION['nivel']; ?>
                </span>
            <?php else: ?>
                ¿Ya eres socio? <a href="login.php">Inicia sesión</a>
            <?php endif; ?>
        </div>
        <div>
            <a href="perfil.php" style="text-decoration: none; color: var(--dark); margin-right: 15px;">📅 Mis Reservas</a>
            <a href="logout.php" style="color: #e74c3c; text-decoration: none;">Salir</a>
        </div>
    </div>

    <?php if ($mensaje): ?>
        <div class="caja-mensaje">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>

    <h1>🎾 Nuestras Pistas</h1>

    <div class="grid-pistas">
        <?php foreach ($pistas as $pista): ?>
            <div class="pista-card">
                <h3><?php echo $pista['nombre']; ?></h3>
                <div class="pista-info">
                    <span>📍 <?php echo $pista['tipo']; ?></span>
                </div>

                <a href="reserva.php?id_pista=<?php echo $pista['id']; ?>" class="btn-reservar">
                    Reservar ahora
                </a>
            </div>
        <?php endforeach; ?>
    </div>

</body>

</html>