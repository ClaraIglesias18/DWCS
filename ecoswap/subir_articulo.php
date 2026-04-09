<?php
session_start();
require_once('db.php');
require_once('funciones.php');

if(!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensaje'] = "Para subir un artículo debes iniciar sesion";
    header('Location: index.php');
    exit();
}

if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];
    $producto = obtener_producto_por_id($conexion, $producto_id);
}

if (isset($producto)) {
    $id = $producto['id'];
    $nombre = $producto['nombre'];
    $descripcion = $producto['descripcion'];
    $precio = $producto['precio'];
    $imagen = $producto['imagen'];
    $categoria = $producto['categoria'];
    $estado = "Disponible";
    $accion = "editar";
} else {
    $id = "";
    $nombre = "";
    $descripcion = "";
    $precio = "";
    $imagen = "";
    $categoria = "";
    $estado = "Disponible";
    $accion = "crear";
}

$usuario_id = $_SESSION['id_usuario'];;

?>
<div class="container" style="max-width: 600px;">
    <h1>Subir/Editar Artículo</h1>
    <form action="articulo_procesar.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="usuario_id" value="<?= $usuario_id ?>">
        <input type="hidden" name="id_producto" value="<?= $id ?>">
        <input type="hidden" name="accion" value="<?= $accion ?>">

        <label>Nombre del producto</label>
        <input type="text" name="nombre" value="<?= $nombre ?>" required>

        <label>Derscripción</label>
        <input type="text" name="descripcion" value="<?= $descripcion ?>" required>


        <label>Precio (€)</label>
        <input type="number" step="0.01" name="price" value="<?= $precio ?>" required>

        <label>Categoría</label>
        <select name="cat">
            <option value="Electrónica" <?php if ($categoria == "Electrónica") echo "selected"; ?>>Electrónica</option>
            <option value="Moda" <?php if ($categoria == "Moda") echo "selected"; ?>>Moda</option>
            <option value="Hogar" <?php if ($categoria == "Hogar") echo "selected"; ?>>Hogar</option>
        </select>

        <label>Imagen (Dejar vacío para no cambiar)</label>
        <input type="file" name="foto">

        <button type="submit" class="btn-vender" style="width:100%; border:none; padding:15px; font-size:1.1rem;">
            Guardar Cambios/Publicar Artículo
        </button>
    </form>
</div>