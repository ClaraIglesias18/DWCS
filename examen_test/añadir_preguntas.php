<?php
session_start();
require_once 'db.php';
require_once 'funciones_tests.php';
require_once 'funciones_preguntas.php';


if(isset($_GET['id'])) {
    $id_test = $_GET['id'];
}

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_test = $_POST['id_test'];
    $enunciado = $_POST['enunciado'];
    $opcion_a = $_POST['a'];
    $opcion_b = $_POST['b'];
    $opcion_c = $_POST['c'];
    $correcta = $_POST['correcta'];

    if (crear_pregunta($conexion, $id_test, $enunciado, $opcion_a, $opcion_b, $opcion_c, $correcta)) {
        $_SESSION['msg'] = "Pregunta añadida exitosamente.";
    } else {
        $_SESSION['msg'] = "Error al añadir la pregunta.";
    }
    mysqli_close($conexion);
    header("Location: añadir_preguntas.php?id=$id_test");
    exit();
}

$preguntas = obtener_preguntas($conexion, $id_test);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Preguntas</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="container">
        <header style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Añadir Preguntas</h1>
        </header>
        <?php if (isset($_SESSION['msg'])): ?>
            <div class="form-card">
                <p style="color: red; text-align: center;"><?php echo $_SESSION['msg']; ?></p>
            </div>
            <?php unset($_SESSION['msg']); ?>
        <?php endif; ?>

        <form action="añadir_preguntas.php" method="POST" class="form-card">
            <input type="hidden" name="id_test" value="<?php echo $id_test; ?>">

            <label for="enunciado">Enunciado de la Pregunta:</label>
            <textarea name="enunciado" placeholder="Escribe la pregunta"></textarea>

            <input type="text" name="a" placeholder="Opción A">
            <input type="text" name="b" placeholder="Opción B">
            <input type="text" name="c" placeholder="Opción C">

            <label for="correcta">Respuesta Correcta:</label>
            <select name="correcta">
                <option value="a">A</option>
                <option value="b">B</option>
                <option value="c">C</option>
            </select>
            <button type="submit">Guardar Pregunta y seguir</button>
            <a href="panel.php">Terminar Test</a>
        </form>
    </div>
    <div class="container">
        <h2>Preguntas Existentes</h2>
        <?php if (count($preguntas) > 0): ?>
            <ul>
                <?php foreach ($preguntas as $pregunta): ?>
                    <li><?php echo $pregunta['enunciado']; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No hay preguntas añadidas aún.</p>
        <?php endif; ?>
</body>