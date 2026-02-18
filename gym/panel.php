<?php
session_start();
require_once 'db.php';
require_once 'funciones_clases.php';
require_once 'funciones_reservas.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
} else {
    $msg = "";
}

$rol = $_SESSION['rol'];

$reservas = obtener_reservas_usuario($conexion, $_SESSION['id_usuario']);
$clases = obtener_clases($conexion);
mysqli_close($conexion);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel GymFit</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        /* Un par de ajustes extra para que el panel no sea una tarjeta pequeña */
        body {
            display: block;
            background: #f4f7f6;
            padding: 40px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Hola, <?php echo $_SESSION['nombre']; ?></h1>
            <a href="logout.php" style="color: red;">Cerrar Sesión</a>
        </header>
        <?php if ($msg): ?>
            <div class="form-card">
                <p style="color: red; text-align: center;"><?php echo $msg; ?></p>
            </div>
        <?php endif; ?>
        <?php if ($rol === 'admin'): ?>
            <form action="crear_clase.php" method="POST" style="margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap;"> 
                <input type="text" name="actividad" placeholder="Actividad (e.g. Yoga)" required> 
                <input type="text" name="dia_semana" placeholder="Día de la Semana" required> 
                <input type="time" name="hora" placeholder="Hora" required> 
                <input type="number" name="cupo_maximo" placeholder="Cupo Máximo" required> 
                <button type="submit">Crear Clase</button> 
            </form>
        <?php endif; ?>

        <h2>Clases Disponibles</h2>
        <table>
            <thead>
                <tr>
                    <th>Actividad</th>
                    <th>Día</th>
                    <th>Hora</th>
                    <th>Cupo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($clases): ?>
                    <?php foreach ($clases as $clase): ?>
                        <tr>
                            <td><?php echo $clase['actividad']; ?></td>
                            <td><?php echo $clase['dia_semana']; ?></td>
                            <td><?php echo $clase['hora']; ?></td>
                            <td><?php echo $clase['cupo_maximo']; ?></td>
                            <td><a href="reservar.php?id=<?php echo $clase['id']; ?>" style="color: green; font-weight: bold;">Reservar</a>
                                <?php if ($rol === 'admin'): ?>
                                    <a href="eliminar_clase.php?id=<?php echo $clase['id']; ?>" style="color: red; font-weight: bold;">Eliminar</a>
                                    <a href="editar_clase.php?id=<?php echo $clase['id']; ?>" style="color: blue; font-weight: bold;">Editar</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">No hay clases disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Mis Reservas Proximas</h2>
        <ul>
            <?php if ($reservas): ?>
                <?php foreach ($reservas as $reserva): ?>
                    <li> <?php echo $reserva['actividad'] . " - " . $reserva['dia_semana'] . " a las " . $reserva['hora']; ?>
                        <a href="cancelar.php?id=<?php echo $reserva['id']; ?>" style="color: gray; font-size: 0.8rem;">(Cancelar)</a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No hay reservas.</td>
                </tr>
            <?php endif; ?>
        </ul>
    </div>
</body>

</html>