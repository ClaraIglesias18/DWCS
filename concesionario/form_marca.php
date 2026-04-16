<?php
session_start();
require_once('db.php');
require_once('funciones_marcas.php');

if(isset($_GET['id_marca'])) {
    $id_marca = $_GET['id_marca'];
    $marca = obtener_marca_id($id_marca, $conexion);
}

if(isset($marca)) {
    $id_marca = $marca['id_marca'];
    $accion = "editar";
    $nombre = $marca['nombre'];
    $pais = $marca['pais'];
} else {
    $id_marca = "";
    $accion = "crear";
    $nombre = "";
    $pais = "";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Marcas</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; padding-top: 50px; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 400px; }
        h2 { margin-top: 0; color: #2c3e50; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-save { background: #27ae60; color: white; border: none; width: 100%; padding: 12px; border-radius: 4px; cursor: pointer; font-size: 16px; }
        .btn-cancel { display: block; text-align: center; margin-top: 15px; color: #7f8c8d; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>

<div class="card">
    <h2>Datos de la Marca</h2>
    <form action="procesar_marca.php" method="POST">

        <input type="hidden" name="id_marca" value="<?= $id_marca ?>">
        <input type="hidden" name="accion" value="<?= $accion ?>">

        <label>Nombre de la Marca</label>
        <input name="nombre" type="text" value="<?= htmlspecialchars($nombre) ?>" required>

        <label>País</label>
        <input name="pais" type="text" value="<?= htmlspecialchars($pais) ?>" required>

        <button type="submit" class="btn-save">Guardar Marca</button>
        <a href="index.php" class="btn-cancel">Cancelar y Volver</a>
    </form>
</div>

</body>
</html>