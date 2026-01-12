<?php
session_start();
require_once 'db.php';
require_once 'funciones_alumnos.php';

$alumno_a_editar = null;

if(!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

if(!isset($_GET['id'])) {
    // Si no hay ID válido, redirigir a lista_alumnos.php con mensaje de error
    $_SESSION['msg'] = "ERROR: ID no valido.";
    header('Location: lista_alumnos.php');
    exit();
}

if(isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
} else {
    $msg = "";
}

$alumno_a_editar = obtener_alumno_por_id($conexion, $_GET['id']);
mysqli_close($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumno - Sistema Escolar</title>
    <style>
        /* 1. CONFIGURACIÓN GENERAL */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .main-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 20px;
        }

        /* 2. MENSAJE DE ESTADO */
        .message-box {
            width: 100%;
            max-width: 400px;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff3cd; /* Amarillo para advertencia/info */
            color: #856404;
            border: 1px solid #ffeeba;
            box-sizing: border-box;
        }

        .close-btn { background: none; border: none; font-weight: bold; cursor: pointer; color: inherit; }

        /* 3. CAJA DE EDICIÓN */
        .edit-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        h2 { text-align: center; margin-top: 0; color: #333; }
        p.subtitle { text-align: center; color: #666; font-size: 14px; margin-bottom: 25px; }

        .input-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 6px; font-size: 14px; color: #555; }
        
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            background-color: #fafafa;
        }

        input:focus { border-color: #ffc107; outline: none; background-color: #fff; }

        /* 4. BOTONES */
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-save {
            flex: 2;
            padding: 12px;
            background-color: #ffc107; /* Amarillo para identificar edición */
            color: #000;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-cancel {
            flex: 1;
            padding: 12px;
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-save:hover { background-color: #e0a800; }
        .btn-cancel:hover { background-color: #5a6268; }
    </style>
</head>
<body>

    <div class="main-wrapper">

        <div class="message-box" id="msg-alert">
            <span><?= htmlspecialchars($msg); ?></span>
            <button class="close-btn" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>

        <div class="edit-container">
            <h2>Editar Alumno</h2>
            <p class="subtitle">Modifica los campos necesarios y guarda los cambios.</p>

            <form action="procesar_alumnos.php" method="POST">
                <input type="hidden" name="accion" value="editar">
                <input type="hidden" name="id_alumno" value="<?= (int)$alumno_a_editar['id_alumno']; ?>">

                <div class="input-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($alumno_a_editar['nombre']); ?>" required>
                </div>

                <div class="input-group">
                    <label>Apellidos</label>
                    <input type="text" name="apellidos" value="<?= htmlspecialchars($alumno_a_editar['apellidos']); ?>" required>
                </div>

                <div class="input-group">
                    <label>Correo Electrónico</label>
                    <input type="email" name="correo" value="<?= htmlspecialchars($alumno_a_editar['correo']); ?>" required>
                </div>

                <div class="input-group">
                    <label>Curso</label>
                    <input type="text" name="curso" value="<?= htmlspecialchars($alumno_a_editar['curso']); ?>" required>
                </div>

                <div class="button-group">
                    <a href="index.php" class="btn-cancel">Cancelar</a>
                    <button type="submit" class="btn-save">Guardar Cambios</button>
                </div>
            </form>
        </div>

    </div>

</body>
</html>