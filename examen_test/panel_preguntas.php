<?php
session_start();
require_once 'funciones_preguntas';

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$preguntas = obtener_preguntas($conexion);

?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Preguntas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <header style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Panel de Preguntas</h1>
            <a href="panel.php" style="color: blue;">Volver al Panel</a>
        </header>
        <div style="margin-top: 20px;">
            <a href="crear_preguntas.php" class="btn">Crear Nueva Pregunta</a>
            <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px;">ID</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Enunciado</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Opciones</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Correcta</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($preguntas as $pregunta): ?>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $pregunta['id']; ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $pregunta['enunciado']; ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px;">
                                A) <?php echo $pregunta['op_a']; ?><br>
                                B) <?php echo $pregunta['op_b']; ?><br>
                                C) <?php echo $pregunta['op_c']; ?>
                            </td>
                            <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $pregunta['correcta']; ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px;">
                                <a href="editar_pregunta.php?id=<?php echo $pregunta['id_pregunta']; ?>" class="btn">Editar</a>
                                <a href="procesar_preguntas.php?id=<?php echo $pregunta['id_pregunta']; ?>" class="btn" style="background-color: red;">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>