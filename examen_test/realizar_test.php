<?php
session_start();
require_once 'db.php';
require_once 'funciones_tests.php';
require_once 'funciones_resultados.php';
require_once 'funciones_preguntas.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$id_test = $_GET['id'];

$preguntas = obtener_preguntas($conexion, $id_test);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Test</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="container">
        <header style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Realizando test</h1>
        </header>
        <form action="procesar_test.php" method="POST">
            <h1>Test: <?= $id_test ?></h1>

            <input type="hidden" name="id_test" value="<?= $id_test ?>">

            <?php foreach ($preguntas as $pregunta): ?>
                <div style="margin-bottom: 20px; border: 1px solid #ddd; padding: 10px;">
                    <p><strong><?= $pregunta['enunciado'] ?></strong></p>

                    <label>
                        <input type="radio" name="respuestas[<?= $pregunta['id_pregunta'] ?>]" value="a" required>
                        <?= $pregunta['op_a'] ?>
                    </label><br>

                    <label>
                        <input type="radio" name="respuestas[<?= $pregunta['id_pregunta'] ?>]" value="b">
                        <?= $pregunta['op_b'] ?>
                    </label><br>

                    <label>
                        <input type="radio" name="respuestas[<?= $pregunta['id_pregunta'] ?>]" value="c">
                        <?= $pregunta['op_c'] ?>
                    </label>
                </div>
            <?php endforeach; ?>

            <button type="submit">Enviar Test</button>
        </form>