<?php
session_start();
require_once('db.php');
require_once('funciones_marcas.php');
require_once('funciones_modelos.php');

if(!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

if(isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
}

$marcas = obtener_marcas($conexion);
$modelos = obtener_modelos($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Concesionario - Panel de Control</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f7f6; color: #333; margin: 40px; }
        h1 { color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        .nav { margin-bottom: 20px; }
        .btn { background: #3498db; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; font-size: 14px; }
        .btn:hover { background: #2980b9; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #34495e; color: white; }
        tr:hover { background-color: #f1f1f1; }
        .actions a { margin-right: 10px; text-decoration: none; color: #e67e22; font-weight: bold; }
        .actions a.delete { color: #e74c3c; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="logout.php" class="btn" style="background: #e74c3c;">Cerrar Sesión</a>
    </div>

    <h1>Gestión de Concesionario</h1>
    
    <div class="nav">
        <a href="form_marca.php" class="btn">+ Nueva Marca</a>
        <a href="form_modelo.php" class="btn">+ Nuevo Modelo</a>
    </div>
    <?php if(isset($msg)): ?>
        <p style="color:red"><?= $msg ?></p>
    <?php endif; ?>  
    <h2>Marcas Registradas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de Marca</th>
                <th>País de Origen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($marcas) > 0): ?>
                <?php foreach($marcas as $marca): ?>
                    <tr>
                        <td><?= $marca['id_marca'] ?></td>
                        <td><?= htmlspecialchars($marca['nombre']) ?></td>
                        <td><?= htmlspecialchars($marca['pais']) ?></td>
                        <td class="actions">
                            <a href="form_marca.php?id_marca=<?= $marca['id_marca'] ?>">Editar</a>
                            <a href="procesar_marca.php?id_marca=<?= $marca['id_marca'] ?>&accion=eliminar" class="delete">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center; color:#7f8c8d;">No hay marcas registradas</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Modelos en Inventario</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Marca Relacionada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($modelos) > 0): ?>
                <?php foreach($modelos as $modelo): ?>
                    <tr>
                        <td><?= $modelo['id_modelo'] ?></td>
                        <td><?= htmlspecialchars($modelo['nombre']) ?></td>
                        <td><?= $modelo['anio'] ?></td>
                        <td><?= htmlspecialchars($modelo['nombre_marca']) ?></td>
                        <td class="actions">
                            <a href="form_modelo.php?id_modelo=<?= $modelo['id_modelo'] ?>">Editar</a>
                            <a href="procesar_modelo.php?id_modelo=<?= $modelo['id_modelo'] ?>&accion=eliminar" class="delete">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center; color:#7f8c8d;">No hay modelos registrados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>