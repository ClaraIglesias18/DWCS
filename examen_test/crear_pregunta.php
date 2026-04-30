<?php
session_start();
require_once 'db.php';
require_once 'funciones_preguntas.php';

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
    <header>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear Pregunta</title>
        <link rel="stylesheet" href="estilos.css">
    </header>
    <body>
        <header style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Crear Nueva Pregunta</h1>
            <a href="panel.php" style="color: red;">Volver al Panel</a>
        </header>
        <div class="form-card">
            <form action="procesar_preguntas.php" method="POST">
                <input type="hidden" name="accion" value="crear">
                <label for="enunciado">Enunciado:</label>
                <textarea id="enunciado" name="enunciado" required></textarea>
                <label for="op_a">Opción A:</label>
                <input type="text" id="op_a" name="op_a" required>
                <label for="op_b">Opción B:</label>
                <input type="text" id="op_b" name="op_b" required>
                <label for="op_c">Opción C:</label>
                <input type="text" id="op_c" name="op_c" required>
                <label for="correcta">Respuesta Correcta (a, b o c):</label>
                <input type="text" id="correcta" name="correcta" required>
                <button type="submit">Crear Pregunta</button>
            </form>
        </div>
    </body>
</html>