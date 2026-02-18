<?php 
session_start();
require_once 'db.php';
require_once 'funciones_clases.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$id_clase = $_GET['id'];
$clase = obtener_clase_id($conexion, $id_clase);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_clase = $_POST['id_clase'];
    $nombre = $_POST['actividad'];
    $hora = $_POST['hora'];
    $dia_semana = $_POST['dia_semana'];
    $cupo_maximo = $_POST['cupo_maximo'];

    if (editar_clase($conexion, $id_clase, $nombre, $hora, $dia_semana, $cupo_maximo)) {
        $_SESSION['msg'] = "Clase editada exitosamente.";
    } else {
        $_SESSION['msg'] = "Error al editar la clase.";
    }
    mysqli_close($conexion);
    header("Location: panel.php");
    exit();
}


?>

<DOCTYPE html>
<html lang="es">
    <header>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Clase</title>
        <link rel="stylesheet" href="estilos.css">
    </header>
    <body>
        <div class="container">
            <header style="display: flex; justify-content: space-between; align-items: center;">
                <h1>Editar Clase</h1>
                <a href="panel.php" style="color: red;">Volver al Panel</a>
            </header>
            <div class="form-card">
                <form action="editar_clase.php" method="POST">
                    <input type="hidden" name="id_clase" value="<?php echo $clase['id']; ?>">
                    <label for="actividad">Nombre de la Clase:</label>
                    <input type="text" id="actividad" name="actividad" value="<?php echo htmlspecialchars($clase['actividad']); ?>" required>

                    <label for="hora">Horario:</label>
                    <input type="time" id="hora" name="hora" value="<?php echo htmlspecialchars($clase['hora']); ?>" required>
                    
                    <label for="dia_semana">Día de la Semana:</label>
                    <input type="text" id="dia_semana" name="dia_semana" value="<?php echo htmlspecialchars($clase['dia_semana']); ?>" required>
                    
                    <label for="cupo_maximo">Cupo Máximo:</label>
                    <input type="number" id="cupo_maximo" name="cupo_maximo" value="<?php echo htmlspecialchars($clase['cupo_maximo']); ?>" required>


                    <button type="submit">Guardar Cambios</button>
                </form>
            </div>
        </div>