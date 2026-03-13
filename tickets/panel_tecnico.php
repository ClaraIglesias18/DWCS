<?php
session_start();
require_once('bd.php');
require_once('funciones_incidencias.php');

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'tecnico') {
    header('Location: index.php');
    exit();
}

$incidencias = obtener_incidencias($conexion);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel Técnico - FixIt</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="container">
        <header style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Gestión Global de Tickets</h1>
            <a href="logout.php" style="color: var(--danger); text-decoration: none;">Cerrar Sesión</a>
        </header>

        <p>Conectado como Técnico: <strong>TÉCNICO</strong></p>

        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Empleado</th>
                    <th>Incidencia</th>
                    <th>Prioridad</th>
                    <th>Estado / Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($incidencias)): ?>
                    <?php foreach ($incidencias as $incidencia): ?>
                        <tr>
                            <td><?= $incidencia['fecha_creacion'] ?></td>
                            <td><?= $incidencia['empleado_nombre'] ?></td>
                            <td><?= $incidencia['titulo'] ?></td>
                            <td>

                                <span <?php if ($incidencia['prioridad'] == 'Alta'): ?> style="color: red" <?php endif; ?>>
                                    <?= $incidencia['prioridad'] ?>
                                </span>
                            </td>
                            <td>
                                <form action="procesar.php" method="POST" style="display: flex; gap: 5px;">
                                    <input type="hidden" name="accion" value="modificar_estado">
                                    <input type="hidden" name="id_incidencia" value="<?= $incidencia['id'] ?>">
                                    <select name="nuevo_estado" style="padding: 2px; font-size: 0.85rem;">
                                        <option value="Abierta">Abierta</option>
                                        <option value="En Proceso">En Proceso</option>
                                        <option value="Resuelta">Resuelta</option>
                                    </select>
                                    <button type="submit" style="padding: 2px 8px; font-size: 0.8rem; background: var(--primary);">OK</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

            </tbody>
        </table>
    </div>
</body>

</html>