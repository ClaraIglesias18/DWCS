<?php
session_start();
require_once 'db.php';
require_once 'funciones_reservas.php'; 

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?msg=sesion_requerida");
    exit;
}

if (isset($_GET['msg'])) {
    $mensaje = $_GET['msg'];
} else {
    $mensaje = '';
}

// Recogemos datos de la URL
$id_pista = $_GET['id_pista'] ?? 1; // Por defecto pista 1 si no hay ID
$fecha_hoy = date('Y-m-d');

// Definimos el horario completo del club
$horario_club = ['09:00', '10:30', '12:00', '16:00', '17:30', '19:00', '20:30'];

// Usamos nuestra nueva función para obtener lo que ya está pillado
$ocupadas = obtener_horas_ocupadas($conexion, $id_pista, $fecha_hoy);


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reservar Pista - Club Deportivo</title>
    <style>
        :root {
            --primary: #3498db;
            --dark: #2c3e50;
            --light: #f4f7f6;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--light);
            padding: 40px;
        }

        .booking-container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .pista-header {
            text-align: center;
            border-bottom: 2px solid #eee;
            margin-bottom: 25px;
            padding-bottom: 15px;
        }

        .pista-header h2 {
            color: var(--primary);
            margin: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: var(--dark);
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1em;
        }

        .info-box {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 0.9em;
            color: #2980b9;
        }

        .btn-confirmar {
            width: 100%;
            background: #2ecc71;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1.1em;
            transition: 0.3s;
        }

        .btn-confirmar:hover {
            background: #27ae60;
            transform: translateY(-2px);
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #95a5a6;
            text-decoration: none;
            font-size: 0.9em;
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

    <div class="booking-container">
        <div class="pista-header">
            <span>Estas reservando en:</span>
            <h2>Pista Central (Cristal)</h2>
        </div>

        <div class="info-box">
            <strong>Recuerda:</strong> Las reservas son de 90 minutos. El pago se realizará en la recepción del club.
        </div>

        <form action="procesar_reserva.php" method="POST">
            <input type="hidden" name="id_pista" value="1">

            <input type="hidden" name="fecha" value="<?php echo $fecha_hoy; ?>">

            <div class="form-group">
                <label for="hora">Horas disponibles:</label>
                <select name="hora" id="hora" required>
                    <option value="">-- Elige un turno --</option>

                    <?php foreach ($horario_club as $turno): ?>
                        <?php if (!in_array($turno, $ocupadas)): ?>
                            <option value="<?php echo $turno; ?>">
                                <?php echo $turno; ?> - <?php echo date('H:i', strtotime($turno . ' + 90 minutes')); ?>
                            </option>
                        <?php else: ?>
                            <option value="" disabled style="color: red;">
                                <?php echo $turno; ?> (Ocupada)
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </select>
            </div>

            <button type="submit" class="btn-confirmar">Confirmar Reserva</button>
        </form>

        <a href="index.php" class="btn-back">← Cancelar y volver</a>
    </div>

</body>

</html>