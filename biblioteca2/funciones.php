<?php

// FUNCIONES LIBROS
function obtener_libros($conexion) {
    $sql = "SELECT libros.id, libros.titulo, libros.anio_publicacion, autores.nombre AS autor FROM libros JOIN autores ON libros.autor_id = autores.id";
    $resultado = mysqli_query($conexion, $sql);
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

function obtener_libro_por_id($conexion, $id) {
    $sql = "SELECT * FROM libros WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($resultado);
}

function insertar_libro($conexion, $titulo, $anio_publicacion, $autor_id) {
    $sql = "INSERT INTO libros (titulo, anio_publicacion, autor_id) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sii", $titulo, $anio_publicacion, $autor_id);
    return mysqli_stmt_execute($stmt);
}

function editar_libro($conexion, $id, $titulo, $anio_publicacion, $autor_id) {
    $sql = "UPDATE libros SET titulo = ?, anio_publicacion = ?, autor_id = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "siii", $titulo, $anio_publicacion, $autor_id, $id);
    return mysqli_stmt_execute($stmt);
}

function eliminar_libro($conexion, $id) {
    $sql = "DELETE FROM libros WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}

// FUNCIONES AUTORES

function obtener_autores($conexion) {
    $sql = "SELECT * FROM autores";
    $resultado = mysqli_query($conexion, $sql);
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

function obtener_autor_por_id($conexion, $id) {
    $sql = "SELECT * FROM autores WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($resultado);
}

function insertar_autor($conexion, $nombre, $nacionalidad) {
    $sql = "INSERT INTO autores (nombre, nacionalidad) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $nombre, $nacionalidad);
    return mysqli_stmt_execute($stmt);
}

function editar_autor($conexion, $id, $nombre, $nacionalidad) {
    $sql = "UPDATE autores SET nombre = ?, nacionalidad = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $nombre, $nacionalidad, $id);
    return mysqli_stmt_execute($stmt);
}

function eliminar_autor($conexion, $id) {
    $sql = "DELETE FROM autores WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}



