<?php
session_start();
require_once "db.php";
require_once "funciones.php";

if(isset($_GET['autor_id'])) {
    $autor_id = $_GET['autor_id'];
    $autor = obtener_autor_por_id($conexion, $autor_id);
}

if(isset($autor)) {
    $id = $autor['id'];
    $nombre = $autor['nombre'];
    $nacionalidad = $autor['nacionalidad'];
    $accion = "editar";
} else {
    $id = "";
    $nombre = "";
    $nacionalidad = "";
    $accion = "crear";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Autor</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Datos del Autor</h1>
    <form action="procesar_autor.php" method="POST">
        <input type="hidden" name="accion" value="<?= $accion ?>">
        <input type="hidden" name="id" value="<?= $id ?>">

        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre completo" value="<?= $nombre ?>" required><br><br>

        <label for="nacionalidad">Nacionalidad:</label><br>
        <input type="text" id="nacionalidad" name="nacionalidad" placeholder="Ej: Mexicana" value="<?= $nacionalidad ?>"><br><br>

        <button type="submit">Guardar Autor</button>
        <a href="index.php">Volver atrás</a>
    </form>
</body>
</html>