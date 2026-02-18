<?php
session_start();
require_once 'db.php';
require_once 'funciones_tests.php';
require_once 'funciones_preguntas.php';

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: panel.php");
    exit();
}

$id_test = $_GET['id'] ?? null;
$id_pregunta = $_GET['id_pregunta'] ?? null;

$pregunta = obtener_pregunta_id($conexion, $id_pregunta);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pregunta = $_POST['id_pregunta'];
    $enunciado = $_POST['enunciado'];
    $op_a = $_POST['op_a'];
    $op_b = $_POST['op_b'];
    $op_c = $_POST['op_c'];
    $correcta = $_POST['correcta'];

    // Actualizar la pregunta
    actualizar_pregunta($conexion, $id_pregunta, $enunciado, $op_a, $op_b, $op_c, $correcta);

    // Redirigir de nuevo al panel o mostrar un mensaje de éxito
    header("Location: panel.php?");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
    <header>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Pregunta</title>
        <link rel="stylesheet" href="estilos.css">
    </header>
    <body>
        <header style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Editar Pregunta</h1>
            <a href="editar_test.php?id=<?php echo $id_test; ?>" style="color: red;">Volver al Test</a>
        </header>
        <div class="form-card">
            <form action="editar_pregunta.php" method="POST">
                <input type="hidden" name="id_pregunta" value="<?php echo $pregunta['id_pregunta']; ?>">
                <input type="hidden" name="id_test" value="<?php echo $id_test; ?>">

                <label for="enunciado">Enunciado:</label>
                <textarea id="enunciado" name="enunciado" required><?php echo htmlspecialchars($pregunta['enunciado']); ?></textarea>

                <label for="op_a">Opción A:</label>
                <input type="text" id="op_a" name="op_a" value="<?php echo htmlspecialchars($pregunta['op_a']); ?>" required>

                <label for="op_b">Opción B:</label>
                <input type="text" id="op_b" name="op_b" value="<?php echo htmlspecialchars($pregunta['op_b']); ?>" required>

                <label for="op_c">Opción C:</label>
                <input type="text" id="op_c" name="op_c" value="<?php echo htmlspecialchars($pregunta['op_c']); ?>" required>

                <label for="correcta">Respuesta Correcta (a, b o c):</label>
                <input type="text" id="correcta" name="correcta" value="<?php echo htmlspecialchars($pregunta['correcta']); ?>" required>

                <button type="submit">Guardar Cambios</button>
            </form>