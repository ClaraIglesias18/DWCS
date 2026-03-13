<?php
session_start();


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Ticket - FixIt</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container" style="max-width: 600px;">
        <h1>Reportar Incidencia</h1>
        <p>Describe el problema técnico lo mejor posible.</p>

        <form action="procesar.php" method="POST">

            <input type="hidden" name="accion" value="insertar_incidencia">
            <input type="hidden" name="usuario_id" value="<?=  $_SESSION['usuario_id'] ?>">

            <div style="margin-bottom: 15px;">
                <label>Título breve del problema</label>
                <input type="text" name="titulo" placeholder="Ej: La impresora no enciende" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label>Prioridad estimada</label>
                <select name="prioridad">
                    <option value="Baja">Baja (Consulta general)</option>
                    <option value="Media" selected>Media (Fallo parcial)</option>
                    <option value="Alta">Alta (Bloqueo total del trabajo)</option>
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label>Descripción detallada</label>
                <textarea name="descripcion" rows="5" placeholder="Explica qué ha pasado..." required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ddd;"></textarea>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" style="flex: 2; background: var(--secondary);">Enviar Incidencia</button>
                <a href="panel_empleado.php" style="flex: 1; text-align: center; background: #eee; color: #333; padding: 10px; text-decoration: none; border-radius: 4px;">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>