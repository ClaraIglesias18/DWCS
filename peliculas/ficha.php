<?php
session_start();
require_once 'funciones.php';

if (!isset($_GET['id'])) {
    header('Location: cartelera.php');
    exit();
}

if(isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
} else {
    $mensaje = '';
}

if (!isset($_SESSION['usuario_id'])) {
    $mensaje = "Debes iniciar sesión para ver las reseñas y poder dejar una.";
    header('Location: cartelera.php?mensaje=' . $mensaje);
    exit();
}

$conexion = conectar_db();
if (!$conexion) {
    $mensaje = "ERROR: No se pudo conectar a la base de datos.";
    header('Location: cartelera.php?mensaje=' . $mensaje);
    exit();
}

// Obtener detalles de la película (simulado aquí)
$id_pelicula = (int)$_GET['id'];
$pelicula = obtener_pelicula_por_id($conexion, $id_pelicula);
if (!$pelicula) {
    $mensaje = "La película no existe.";
    header('Location: cartelera.php?mensaje=' . $mensaje);
    exit();
}

$valoraciones = obtener_valoraciones_por_pelicula($conexion, $id_pelicula);
cerrar_db($conexion);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reseñas de Película</title>
    <style>
        :root {
            --primary: #e74c3c;
            --dark: #1a1a1a;
            --light: #f4f4f4;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--light);
            padding: 20px;
        }

        .movie-card {
            background: white;
            max-width: 600px;
            margin: auto;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Sección de reseñas */
        .resena {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .resena:last-child {
            border: none;
        }

        .user-name {
            font-weight: bold;
            color: var(--primary);
            font-size: 0.9em;
        }

        .stars {
            color: #f1c40f;
        }

        .comment-text {
            font-style: italic;
            margin-top: 5px;
            color: #555;
        }

        /* Formulario de dejar reseña */
        .form-review {
            background: #fff8f8;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="movie-card">
        <?php if (!empty($mensaje)): ?>
            <div style="background: #ffdddd; color: #a94442; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #ebccd1;">
                <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>
        <a href="cartelera.php" style="font-size: 0.8em; color: #666;">← Volver</a>
        <h1><?= $pelicula['titulo'] . ', ' . $pelicula['anio'] ?></h1>
        <p><strong>Género:</strong> <?= $pelicula['genero'] ?></p>

        <hr>

        <h3>💬 Reseñas de la comunidad</h3>

        <?php if (empty($valoraciones)): ?>
            <p>No hay reseñas aún. ¡Sé el primero en dejar una!</p>
        <?php else: ?>
            <?php foreach ($valoraciones as $valoracion): ?>
                <div class="resena">
                    <div class="user-name">@<?= htmlspecialchars($valoracion['username']) ?></div>
                    <div class="stars"><?= str_repeat('⭐', $valoracion['estrellas']) ?></div>
                    <p class="comment-text">"<?= htmlspecialchars($valoracion['comentario']) ?>"</p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="form-review">
            <h4>Escribe tu reseña:</h4>
            <form action="procesar.php" method="POST">
                <input type="hidden" name="accion" value="valorar">
                <input type="hidden" name="id_pelicula" value="<?= $id_pelicula ?>">
                <input type="hidden" name="usuario_id" value="<?= $_SESSION['usuario_id'] ?>">
                <select name="estrellas">
                    <option value="5">5 Estrellas</option>
                    <option value="4">4 Estrellas</option>
                    <option value="3">3 Estrellas</option>
                    <option value="2">2 Estrellas</option>
                    <option value="1">1 Estrella</option>
                </select>
                <br><br>
                <textarea name="comentario" rows="3" placeholder="¿Qué te ha parecido la película?"></textarea>
                <button type="submit">Publicar Reseña</button>
            </form>
        </div>
    </div>

</body>

</html>