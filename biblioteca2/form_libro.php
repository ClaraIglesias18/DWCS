<?php
require_once "db.php";
require_once "funciones.php";

if(isset($_GET['libro_id'])) {
    $libro_id = $_GET['libro_id'];
    $libro = obtener_libro_por_id($conexion, $libro_id);
}

if(isset($libro)) {
    $id = $libro['id'];
    $titulo = $libro['titulo'];
    $anio_publicacion = $libro['anio_publicacion'];
    $autor_id = $libro['autor_id'];
    $accion = "editar";
} else {
    $id = "";
    $titulo = "";
    $anio_publicacion = "";
    $autor_id = "";
    $accion = "crear";
}

$autores = obtener_autores($conexion);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Libro</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Datos del Libro</h1>
    <form action="procesar_libro.php" method="POST">
        <input type="hidden" name="libro_id" value="<?= $libro_id ?>">
        <input type="hidden" name="accion" value="<?= $accion ?>">

        <label for="titulo">Título del Libro:</label><br>
        <input type="text" id="titulo" name="titulo" value="<?= $titulo ?>" required><br><br>

        <label for="anio_publicacion">Año de publicación:</label><br>
        <input type="number" id="anio_publicacion" name="anio_publicacion" value="<?= $anio_publicacion ?>"><br><br>

        <label for="autor_id">Autor:</label><br>
        <select id="autor_id" name="autor_id">
            <?php foreach($autores as $autor): ?>
                <option value="<?= $autor['id'] ?>" <?= ($autor['id'] == $autor_id) ? "selected" : "" ?>><?= $autor['nombre'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Guardar Libro</button>
        <a href="index.php">Volver atrás</a>
    </form>
</body>
</html>