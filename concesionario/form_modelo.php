<?php
session_start();
require_once('db.php');
require_once('funciones_modelos.php');
require_once('funciones_marcas.php');

if(isset($_GET['id_modelo'])) {
    $id_modelo = $_GET['id_modelo'];
    $modelo = obtener_modelo_id($id_modelo, $conexion);
}

if(isset($modelo)) {
    $id_modelo = $modelo['id_modelo'];
    $accion = "editar";
    $nombre = $modelo['nombre'];
    $anio = $modelo['anio'];
    $id_marca = $modelo['id_marca'];
} else {
    $id_modelo = "";
    $accion = "crear";
    $nombre = "";
    $anio = "";
    $id_marca = "";
}

$marcas = obtener_marcas($conexion);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Modelos</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; padding-top: 50px; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 400px; }
        h2 { margin-top: 0; color: #2c3e50; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-save { background: #27ae60; color: white; border: none; width: 100%; padding: 12px; border-radius: 4px; cursor: pointer; font-size: 16px; }
        .btn-cancel { display: block; text-align: center; margin-top: 15px; color: #7f8c8d; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>

<div class="card">
    <h2>Datos del Modelo</h2>
    <form action="procesar_modelo.php" method="POST">
        <input type="hidden" name="id_modelo" value="<?= $id_modelo ?>">
        <input type="hidden" name="accion" value="<?= $accion ?>">

        <label>Nombre del Modelo</label>
        <input name="nombre" type="text" value="<?= htmlspecialchars($nombre) ?>" placeholder="Ej: Ibiza, Model S..." required>

        <label>Año de Fabricación</label>
        <input name="anio" type="number" value="<?= htmlspecialchars($anio) ?>" placeholder="Ej: 2023" required>

        <label>Seleccionar Marca</label>
        <?php if(count($marcas) > 0): ?>
            <select name="id_marca" required>
                <option value="">-- Selecciona una marca --</option>
                <?php foreach($marcas as $marca): ?>
                    <option value="<?= $marca['id_marca'] ?>" <?= ($marca['id_marca'] == $id_marca) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($marca['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
        <button type="submit" class="btn-save">Guardar Vehículo</button>
        <a href="index.php" class="btn-cancel">Cancelar y Volver</a>
    </form>
</div>

</body>
</html>