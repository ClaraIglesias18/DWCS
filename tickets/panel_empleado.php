<?php
session_start();
require_once('bd.php');
require_once('funciones_incidencias.php');

if (!isset($_SESSION['rol'])) {
    header('Location: index.php');
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$incidencias = obtener_incidencia_empleado($conexion, $usuario_id);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel Empleado - FixIt</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="container">
        <header style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Mis Tickets</h1>
            <a href="logout.php" style="color: var(--danger); text-decoration: none;">Cerrar Sesión</a>
        </header>

        <p>Bienvenido, <strong>USUARIO</strong></p>

        <div style="margin: 20px 0; text-align: right;">
            <a href="nuevo_ticket.php" style="background: var(--secondary); color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold;">
                + Reportar Nueva Incidencia
            </a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Título</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($incidencias)): ?>
                    <?php foreach ($incidencias as $incidencia): ?>
                        <tr>
                            <td><?= $incidencia['fecha_creacion'] ?></td>
                            <td><?= $incidencia['titulo'] ?></td>
                            <td><?= $incidencia['prioridad'] ?></td>
                            <td <?php if($incidencia['estado'] == 'Abierta'): ?>
                            
                            
                            ><?= $incidencia['estado'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 20px;">No has creado ninguna incidencia todavía.</td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>
    </div>
</body>

</html>