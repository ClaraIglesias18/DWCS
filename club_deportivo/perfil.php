<?php
session_start();
require_once 'db.php';
require_once 'funciones_reservas.php';

// 1. Protección: Si no está logueado, al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['msg'])) {
    $mensaje = $_GET['msg'];
} else {
    $mensaje = '';
}

$id_usuario = $_SESSION['usuario_id'];
$username = $_SESSION['username'];
$nivel = $_SESSION['nivel'];

// 2. Traemos las reservas reales de este usuario usando la función con JOIN
$mis_reservas = obtener_reservas_usuario($conexion, $id_usuario);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mi Perfil - <?php echo $username; ?></title>
    <style>
        :root {
            --primary: #3498db;
            --dark: #2c3e50;
            --light: #f4f7f6;
            --danger: #e74c3c;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--light);
            padding: 40px;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .profile-header {
            background: white;
            padding: 25px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .avatar {
            background: var(--primary);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5em;
            font-weight: bold;
        }

        .reserva-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 5px solid var(--primary);
        }

        .btn-cancelar {
            color: var(--danger);
            text-decoration: none;
            border: 1px solid var(--danger);
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8em;
        }

        .btn-cancelar:hover {
            background: var(--danger);
            color: white;
        }

        .no-reservas {
            background: white;
            padding: 40px;
            text-align: center;
            border-radius: 12px;
            color: #7f8c8d;
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
    <div class="container">
        <a href="index.php" style="text-decoration:none; color:var(--primary);">← Volver a pistas</a>

        <div class="profile-header">
            <div class="avatar"><?php echo strtoupper(substr($username, 0, 1)); ?></div>
            <div>
                <h1 style="margin:0;">Hola, @<?php echo $username; ?></h1>
                <span style="color:#7f8c8d;">Nivel: <strong><?php echo $nivel; ?></strong></span>
            </div>
        </div>

        <h2>📅 Mis Reservas Confirmadas</h2>

        <?php if (empty($mis_reservas)): ?>
            <div class="no-reservas">
                <p>Todavía no tienes ninguna reserva. ¡Anímate a jugar hoy!</p>
                <a href="index.php" style="color:var(--primary);">Ver disponibilidad de pistas</a>
            </div>
        <?php else: ?>
            <div class="reservas-list">
                <?php foreach ($mis_reservas as $reserva): ?>
                    <div class="reserva-card">
                        <div>
                            <h3 style="margin:0;"><?php echo $reserva['nombre_pista']; ?></h3>
                            <p style="margin:5px 0; color:#666;">
                                📅 <?php echo date("d/m/Y", strtotime($reserva['fecha'])); ?> |
                                🕒 <?php echo substr($reserva['hora'], 0, 5); ?>h
                            </p>
                            <small style="color:#95a5a6;">Tipo: <?php echo $reserva['tipo']; ?></small>
                        </div>
                        <div>
                            <a href="cancelar_reserva.php?id=<?php echo $reserva['id']; ?>"
                                class="btn-cancelar"
                                onclick="return confirm('¿Estás seguro de que quieres cancelar esta reserva?')">
                                Cancelar
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>

</body>

</html>