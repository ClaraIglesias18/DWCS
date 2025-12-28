<?php
session_start();
require_once 'funciones.php';

$tarea_a_editar = null;
$mensaje = '';

// Validamos si el usuario esta inciciado
if(!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

// Comporbamos que nos viene el ID de la tarea desde index.php para poder trabajar con ella
if (!isset($_GET['id'])) {
    // Si no hay ID válido, redirigir a index.php con mensaje de error
    $mensaje = "ERROR: ID no valido.";
    header('Location: index.php?mensaje=' . $mensaje);
    exit();
}

// Recogemos el ID
$id_edicion = (int)$_GET['id'];

// Obtenemos conexion
$conexion = conectar_db();
if (!$conexion) {
    $mensaje = "ERROR: No se pudo conectar a la base de datos.";
    header('Location: index.php?mensaje=' . $mensaje);
    exit();
}


$tarea_a_editar = obtener_tarea_por_id($conexion, $id_edicion);
cerrar_db($conexion);

// Si no se encuentra el tarea, redirigir a index.php con mensaje de error
if (!$tarea_a_editar) {
    $mensaje = "ERROR: La tarea no existe";
    header('Location: index.php?mensaje=' . $mensaje);
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar: <?php echo htmlspecialchars($tarea_a_editar['titulo']); ?></title>
    <style>
        :root {
            --primary: #4a90e2;
            --secondary: #6c757d;
            --dark: #2c3e50;
            --light: #f4f7f6;
        }
        body { font-family: 'Segoe UI', sans-serif; background-color: var(--light); color: var(--dark); margin: 0; padding: 40px; }
        .container { max-width: 500px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        h1 { font-size: 1.5rem; margin-bottom: 25px; border-left: 5px solid var(--primary); padding-left: 15px; }
        
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; font-size: 0.9em; }
        
        input[type="text"], select {
            width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; box-sizing: border-box; outline: none; transition: border-color 0.3s;
        }
        input[type="text"]:focus, select:focus { border-color: var(--primary); }

        .button-group { display: flex; align-items: center; gap: 15px; margin-top: 30px; }
        button { background: var(--primary); color: white; border: none; padding: 12px 25px; border-radius: 8px; cursor: pointer; font-weight: bold; flex: 1; }
        button:hover { background: #357abd; }
        
        .btn-cancel { text-decoration: none; color: var(--secondary); font-size: 0.9em; }
        .btn-cancel:hover { text-decoration: underline; }

        .alert { padding: 12px; background: #fff3f3; color: #d9534f; border-left: 4px solid #d9534f; margin-bottom: 20px; border-radius: 4px; }
    </style>
</head>
<body>

<div class="container">
    <h1>Editar Tarea</h1>

    <form action="procesar.php" method="POST">
        <input type="hidden" name="accion" value="editar">
        <input type="hidden" name="id_edicion" value="<?php echo (int)$tarea_a_editar['id']; ?>">

        <div class="form-group">
            <label for="titulo">Título de la tarea</label>
            <input type="text" id="titulo" name="titulo" required 
                   value="<?php echo htmlspecialchars($tarea_a_editar['titulo']); ?>" 
                   placeholder="Ej: Terminar informe">
        </div>

        <div class="form-group">
            <label for="estado">Estado de la tarea</label>
            <select name="completada" id="estado">
                <option value="0" <?php echo !$tarea_a_editar['completada'] ? 'selected' : ''; ?>>
                    Pendiente
                </option>
                <option value="1" <?php echo $tarea_a_editar['completada'] ? 'selected' : ''; ?>>
                    Completada
                </option>
            </select>
        </div>

        <div class="button-group">
            <button type="submit">Guardar Cambios</button>
            <a href="index.php" class="btn-cancel">Cancelar</a>
        </div>
    </form>
</div>

</body>
</html>