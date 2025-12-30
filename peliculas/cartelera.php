<?php
session_start();
require_once 'funciones.php';

$conexion = conectar_db();
if (!$conexion) {
    $mensaje = "ERROR: No se pudo conectar a la base de datos.";
    header('Location: login.php?mensaje=' . $mensaje);
    exit();
}

if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
} else {
    $mensaje = '';
}

$peliculas = obtener_peliculas($conexion);
cerrar_db($conexion);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartelera - Cinefilia List</title>
    <style>
        :root {
            --primary: #e74c3c;
            --dark: #1a1a1a;
            --light: #f4f4f4;
            --secondary: #6c757d;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--light);
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        /* Cabecera optimizada */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .nav-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-nav {
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 0.9em;
            transition: 0.3s;
        }

        .btn-login {
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-login:hover {
            background: var(--primary);
            color: white;
        }

        .btn-logout {
            background: #333;
            color: white;
            border: 2px solid #333;
        }

        .btn-logout:hover {
            background: #000;
            border-color: #000;
        }

        .user-welcome {
            font-size: 0.9em;
            color: #555;
        }

        /* Cuadrícula de películas */
        .movie-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        /* Tarjeta de cada película */
        .movie-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
        }

        .movie-card:hover {
            transform: translateY(-5px);
        }

        .movie-info {
            padding: 20px;
            flex-grow: 1;
        }

        .movie-title {
            font-size: 1.3rem;
            font-weight: bold;
            margin: 0 0 10px 0;
            color: var(--dark);
        }

        .movie-genre {
            display: inline-block;
            background: #eee;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 15px;
        }

        .btn-view {
            display: block;
            text-align: center;
            background: var(--dark);
            color: white;
            text-decoration: none;
            padding: 12px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-view:hover {
            background: var(--primary);
        }

        .no-movies {
            text-align: center;
            padding: 50px;
            background: white;
            border-radius: 12px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>🎬 Cartelera de Películas</h1>

            <div class="nav-buttons">
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <span class="user-welcome">Hola, <strong><?php echo $_SESSION['usuario_nombre']; ?></strong></span>
                    <a href="logout.php" class="btn-nav btn-logout">Cerrar Sesión</a>
                <?php else: ?>
                    <a href="login.php" class="btn-nav btn-login">Iniciar Sesión</a>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($mensaje)): ?>
            <div style="background: #ffdddd; color: #a94442; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #ebccd1;">
                <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>

        <?php if (is_array($peliculas) && count($peliculas) > 0): ?>
            <div class="movie-grid">
                <?php foreach ($peliculas as $pelicula): ?>
                    <div class="movie-card">
                        <div class="movie-info">
                            <span class="movie-genre"><?= htmlspecialchars($pelicula['genero']) ?></span>
                            <h3 class="movie-title"><?= htmlspecialchars($pelicula['titulo']) ?></h3>
                            <p style="color: #777; font-size: 0.9em;">Dirigida por <?= htmlspecialchars($pelicula['director']) ?>.</p>
                        </div>
                        <a href="ficha.php?id=<?= $pelicula['id'] ?>" class="btn-view">Ver Ficha y Reseñas</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-movies">
                <p>No hay películas disponibles en este momento.</p>
            </div>
        <?php endif; ?>
</body>

</html>