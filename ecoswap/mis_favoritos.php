<?php
session_start();
require_once('db.php');
require_once('funciones.php');

if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
} else {
    $mensaje = '';
}

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensaje'] = "Para ver los favoritos debes iniciar sesion";
    header('Location: index.php');
    exit();
}
$id_usuario = $_SESSION['id_usuario'];

$favoritos = obtener_favoritos($conexion, $id_usuario);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Favoritos - EcoSwap</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <nav>
        <a href="index.php" class="logo">EcoSwap</a>
        <div class="nav-links">
            <a href="index.php">Catálogo</a>
            <a href="mis_articulos.php">Mis Artículos</a>
            <a href="logout.php">Salir</a>
        </div>
    </nav>

    <div class="container">
        <h1>Mis Favoritos</h1>
        <?php if (isset($mensaje)): ?>
            <p><?= $mensaje ?></p>
        <?php endif; ?>
        <div class="productos-grid">
            <?php if (isset($favoritos)): ?>
                <?php foreach ($favoritos as $favorito): ?>
                    <div class="card">
                        <img src="img/<?php echo $favorito['imagen']; ?>" alt="<?php echo htmlspecialchars($favorito['nombre']); ?>">
                        <div class="card-body">
                            <div class="card-price"><?php echo number_format($favorito['precio'], 2, ',', '.'); ?>€</div>
                            <h3 class="card-title"><?php echo htmlspecialchars($favorito['nombre']); ?></h3>
                            <a href="cambiar_favorito.php?id=<?= $favorito['producto_id'] ?>" class="btn btn-fav active">
                                Quitar de favoritos
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aún no has guardado ningún producto como favorito.</p>
                <a href="index.php">Explorar el catálogo</a>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>