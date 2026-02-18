<?php
session_start();
require_once 'db.php';
require_once 'funciones_tests.php';
require_once 'funciones_preguntas.php';

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: panel.php");
    exit();
}

$id_test = $_GET['id'];

$test = obtener_test_id($conexion,$id_test);
$preguntas = obtener_preguntas($conexion, $id_test);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_test = $_POST['id_test'];
    $titulo = $_POST['titulo'];

    // Actualizar el título del test
    actualizar_test($conexion, $id_test, $titulo);

    // Redirigir de nuevo al panel o mostrar un mensaje de éxito
    header("Location: panel.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
    <header>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Test</title>
        <link rel="stylesheet" href="estilos.css">
    </header>
    <body>
        <div class="container">
            <header style="display: flex; justify-content: space-between; align-items: center;">
                <h1>Editar Test</h1>
            </header>
            <div class="form-card">
                <form action="editar_test.php" method="POST">
                    <input type="hidden" name="id_test" value="<?php echo $test['id_test']; ?>">
                    <label for="titulo">Título del Test:</label>
                    <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($test['titulo']); ?>" required>
                    <button type="submit">Guardar Cambios</button>
                </form>
            </div>
        </div>
        <div class="container">
            <h2>Preguntas del Test</h2>
            <?php foreach ($preguntas as $pregunta): ?>
                <div style="margin-bottom: 20px; border: 1px solid #ddd; padding: 10px;">
                    <p><strong><?php echo htmlspecialchars($pregunta['enunciado']); ?></strong></p>
                    <p>A) <?php echo htmlspecialchars($pregunta['op_a']); ?></p>
                    <p>B) <?php echo htmlspecialchars($pregunta['op_b']); ?></p>
                    <p>C) <?php echo htmlspecialchars($pregunta['op_c']); ?></p>
                    <a href="editar_pregunta.php?id_pregunta=<?php echo $pregunta['id_pregunta']; ?>&id_test=<?php echo $test['id_test']; ?>">Editar Pregunta</a>
                </div>
            <?php endforeach; ?>