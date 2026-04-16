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
            <tr>
                <td>1</td>
                <td>Toyota</td>
                <td>Japón</td>
                <td class="actions">
                    <a href="#">Editar</a>
                    <a href="#" class="delete">Eliminar</a>
                </td>
            </tr>
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
            <tr>
                <td>1</td>
                <td>Corolla</td>
                <td>2022</td>
                <td>Toyota</td>
                <td class="actions">
                    <a href="#">Editar</a>
                    <a href="#" class="delete">Eliminar</a>
                </td>
            </tr>
        </tbody>
    </table>

</body>
</html>