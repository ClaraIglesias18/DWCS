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
    <form action="#">
        <label>Nombre de la Marca</label>
        <input type="text" placeholder="Ej: BMW, Seat..." required>

        <label>País</label>
        <input type="text" placeholder="Ej: Alemania, España..." required>

        <button type="submit" class="btn-save">Guardar Marca</button>
        <a href="index.html" class="btn-cancel">Cancelar y Volver</a>
    </form>
</div>

</body>
</html>