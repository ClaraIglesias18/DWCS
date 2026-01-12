<?php
session_start();
require_once 'db.php';
require_once 'funciones_alumnos.php';

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['msg'] = "Por favor, inicie sesión para continuar.";
    header('Location: login.php');
    exit();
}

// Obtenemos el mensaje de la sesión si existe
if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
} else {
    $msg = "";
}

$es_admin = false;
if ($_SESSION['rol'] == 'admin') {
    $es_admin = true;
}

$alumnos = obtener_alumnos($conexion);

mysqli_close($conexion);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Alumnos - Sistema Escolar</title>
    <style>
        /* 1. CONFIGURACIÓN GENERAL */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            display: flex;
            justify-content: center;
            padding-top: 40px;
            /* Espacio superior para no pegar el mensaje al borde */
            min-height: 100vh;
        }

        .main-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 90%;
            max-width: 1000px;
        }

        /* 2. MENSAJE DE ESTADO */
        .message-box {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
            box-sizing: border-box;
        }

        .close-btn {
            background: none;
            border: none;
            font-weight: bold;
            cursor: pointer;
            color: inherit;
        }

        /* 3. FORMULARIO PARA ADMIN (Añadir Alumno) */
        .admin-section {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin-bottom: 30px;
            box-sizing: border-box;
        }

        .admin-section h2 {
            margin-top: 0;
            color: #333;
            font-size: 20px;
        }

        .form-row {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            /* Para que sea responsivo */
        }

        .form-group {
            flex: 1;
            min-width: 150px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 13px;
            color: #666;
        }

        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-add {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            align-self: flex-end;
            height: 38px;
        }

        /* 4. TABLA DE ALUMNOS */
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f8f9fa;
            color: #333;
        }

        /* Botones de acción dentro de la tabla */
        .btn-edit {
            background-color: #ffc107;
            color: #000;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
            margin-right: 5px;
            border: none;
            cursor: pointer;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
            border: none;
            cursor: pointer;
        }

        .btn-logout:hover {
            background-color: #c82333;
        }

        /* Cambia a rojo al pasar el ratón */
    </style>
</head>

<body>

    <div class="main-wrapper">
        <div class="header-bar" style="width: 100%; max-width: 1000px; display: flex; justify-content: flex-end; margin-bottom: 10px;">
            <div class="user-info" style="margin-right: 20px; align-self: center; color: #666; font-size: 14px;">
                Hola, <strong><?php echo $_SESSION['username']; ?></strong> (<?php echo $_SESSION['rol']; ?>)
            </div>
            <a href="logout.php" class="btn-logout" style="background-color: #6c757d; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 14px; transition: 0.3s;">
                Cerrar Sesión
            </a>
        </div>

        <div class="message-box" id="msg-alert">
            <span><?= htmlspecialchars($msg); ?></span>
            <button class="close-btn" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>

        <?php if ($es_admin): ?>
            <div class="admin-section">
                <h2>Panel de Administrador: Añadir Nuevo Alumno</h2>
                <form action="procesar_alumnos.php" method="POST" class="form-row">
                    <input type="hidden" name="accion" value="añadir">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" placeholder="Nombre" required>
                    </div>
                    <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" name="apellidos" placeholder="Apellidos" required>
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="correo" placeholder="correo@ejemplo.com" required>
                    </div>
                    <div class="form-group">
                        <label>Curso</label>
                        <input type="text" name="curso" placeholder="Ej. ASIR1" required>
                    </div>
                    <button type="submit" class="btn-add">Registrar Alumno</button>
                </form>
            </div>
        <?php endif; ?>

        <div class="table-container">
            <h2>Lista de Alumnos Inscritos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Curso</th>
                        <th>Acciones (Solo Admin)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (is_array($alumnos) && count($alumnos) > 0): ?>
                        <?php foreach ($alumnos as $alumno): ?>
                            <tr>
                                <td><?= htmlspecialchars($alumno['nombre']) ?></td>
                                <td><?= htmlspecialchars($alumno['apellidos']) ?></td>
                                <td><?= htmlspecialchars($alumno['correo']) ?></td>
                                <td><?= htmlspecialchars($alumno['curso']) ?></td>

                                <?php if ($es_admin): ?>
                                    <td>
                                        <a href="editar.php?id=<?php echo $alumno['id_alumno']; ?>" class="btn btn-edit">Editar</a>
                                        <a href="procesar_alumnos.php?id=<?php echo $alumno['id_alumno']; ?>" class="btn btn-delete">Borrar</a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>