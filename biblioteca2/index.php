<?php
session_start();
require_once "db.php";
require_once "funciones.php";

$autores = obtener_autores($conexion);
$libros = obtener_libros($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Biblioteca</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Gestión de Biblioteca</h1>

    <section>
        <h2>Autores</h2>
        <a href="form_autor.php" class="btn-nuevo">Nuevo Autor</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Nacionalidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($autores) > 0): ?>
                    <?php foreach($autores as $autor): ?>
                        <tr>
                            <td><?php echo $autor['id']; ?></td>
                            <td><?php echo $autor['nombre']; ?></td>
                            <td><?php echo $autor['nacionalidad']; ?></td>
                            <td>
                                <a href="form_autor.php?autor_id=<?php echo $autor['id']; ?>">Editar</a>
                                <a href="procesar_autor.php?autor_id=<?php echo $autor['id']; ?>&accion=eliminar">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2>Libros</h2>
        <a href="form_libro.php" class="btn-nuevo">Nuevo Libro</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Año</th>
                    <th>Autor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($libros) > 0): ?>
                    <?php foreach($libros as $libro): ?>
                        <tr>
                            <td><?php echo $libro['id']; ?></td>
                            <td><?php echo $libro['titulo']; ?></td>
                            <td><?php echo $libro['anio_publicacion']; ?></td>
                            <td><?php echo $libro['autor']; ?></td>
                            <td>
                                <a href="form_libro.php?libro_id=<?php echo $libro['id']; ?>">Editar</a>
                                <a href="procesar_libro.php?libro_id=<?php echo $libro['id']; ?>&accion=eliminar">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
</body>
</html>