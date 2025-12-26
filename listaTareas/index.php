<?php
session_start();
require_once('funciones.php');

if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
} else {
    $mensaje = '';
}

// Obtenemos conexion
$conexion = conectar_db();
if (!$conexion) {
    $mensaje = "ERROR: No se pudo conectar a la base de datos.";
    header("Location: login.php?mensaje=" . $mensaje);
    exit();
}

// Obtenemos las tareas
$tareas = obtener_tareas($conexion);
cerrar_db($conexion);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <style>
        :root {
            --primary: #4a90e2;
            --success: #27ae60;
            --danger: #e74c3c;
            --dark: #2c3e50;
            --light: #f4f7f6;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light);
            color: var(--dark);
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: var(--dark);
            margin-bottom: 30px;
        }

        /* Mensajes */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        /* Formulario */
        .form-crear {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        input[type="text"] {
            flex: 1;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            border-color: var(--primary);
        }

        button[type="submit"] {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        button[type="submit"]:hover {
            background: #357abd;
        }

        /* Tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            text-align: left;
            background: #f8f9fa;
            padding: 15px;
            border-bottom: 2px solid #eee;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background-color: #fcfcfc;
        }

        /* Badges de Estado */
        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: bold;
            display: inline-block;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-pending {
            background: #fff3cd;
            color: #856404;
        }

        /* Botones de acción */
        .btn {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.9em;
            margin-right: 5px;
            color: white;
        }

        .btn-edit {
            background: var(--primary);
        }

        .btn-delete {
            background: var(--danger);
        }

        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>📝 Mis Tareas</h1>

        <?php if (!empty($mensaje)): ?>
            <div class="alert"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <form action="procesar.php" class="form-crear" method="POST">
            <input type="hidden" name="accion" value="crear">
            <input type="text" name="titulo" placeholder="Ej: Comprar pan..." required>
            <button type="submit">Añadir Tarea</button>
        </form>

        <?php if (is_array($tareas) && count($tareas) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Creación</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tareas as $tarea): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($tarea['titulo']); ?></strong></td>
                            <td><?php echo date("d/m/Y", strtotime($tarea['fecha_creacion'])); ?></td>
                            <td>
                                <?php if ($tarea['completada']): ?>
                                    <span class="badge badge-success">Completada</span>
                                <?php else: ?>
                                    <span class="badge badge-pending">Pendiente</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="editar.php?id=<?php echo $tarea['id']; ?>" class="btn btn-edit">Editar</a>
                                <a href="procesar.php?accion=borrar&id=<?php echo $tarea['id']; ?>"
                                    class="btn btn-delete"
                                    onclick="return confirm('¿Estás seguro?')">Borrar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align:center; color: #777;">No tienes tareas pendientes. ¡Buen trabajo!</p>
        <?php endif; ?>
    </div>

</body>

</html>