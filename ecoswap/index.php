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

if (isset($_GET['categoria']) && $_GET['categoria'] !== '') {
    $categoria = $_GET['categoria'];
} else {
    $categoria = null;
}

$productos = obtener_productos($conexion, $categoria);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>EcoSwap - Compra y Venta</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <nav>
        <a href="index.php" class="logo">EcoSwap</a>
        <div class="nav-links">
            <a href="index.php">Inicio</a>
            <a href="mis_articulos.php">Mis Artículos</a>
            <a href="mis_favoritos.php">Mis Favoritos</a>
            <a href="subir_articulo.php" class="btn-vender" style="color:white; padding: 5px 10px; border-radius: 4px;">+ Vender</a>
            <a href="logout.php" style="color: var(--danger);">Salir</a>
            <a href="login.php">Iniciar Sesión</a>
            <a href="registro.php" style="font-weight: bold; color: var(--primary);">Registrarse</a>
        </div>
    </nav>

    <div class="container">
        <header style="margin-bottom: 30px; text-align: center;">
            <h1>Encuentra lo que buscas</h1>
            <?php if (isset($mensaje)): ?>
                <p><?= $mensaje ?></p>
            <?php endif; ?>
            <form action="index.php" method="GET" style="display: inline-block; background: none; box-shadow: none; padding: 0;">
                <select name="categoria" onchange="this.form.submit()" style="width: auto; min-width: 250px;">
                    <option value="">Todas las categorías</option>
                    <option value="Electrónica" <?php echo $categoria == 'Electrónica' ? 'selected' : ''; ?>>Electrónica</option>
                    <option value="Hogar" <?php echo $categoria == 'Hogar' ? 'selected' : ''; ?>>Hogar</option>
                    <option value="Moda" <?php echo $categoria == 'Moda' ? 'selected' : ''; ?>>Moda</option>
                    <option value="Motor" <?php echo $categoria == 'Motor' ? 'selected' : ''; ?>>Motor</option>
                    <option value="Otros" <?php echo $categoria == 'Otros' ? 'selected' : ''; ?>>Otros</option>
                </select>
            </form>
        </header>

        <div class="productos-grid">
            <?php if (isset($productos) && !empty($productos)): ?>
                <?php foreach ($productos as $producto): ?>
                    <div class="card">
                        <img src="img/<?php echo $producto['imagen']; ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">

                        <div class="card-body">
                            <div class="card-price"><?php echo number_format($producto['precio'], 2, ',', '.'); ?>€</div>
                            <p class="card-cat"><?php echo $producto['categoria']; ?></p>
                            <h3 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h3>

                            <hr style="border: 0; border-top: 1px solid #eee; margin: 10px 0;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <a href="toggle_favorito.php?id=<?php echo $producto['id']; ?>" class="btn btn-fav">
                                    ❤ Favorito
                                </a>
                                <small style="color: #999;">Ver más</small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 50px;">
                    <h3>No se han encontrado productos en esta categoría.</h3>
                    <a href="index.php">Ver todos los productos</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>