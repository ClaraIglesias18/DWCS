<?php

function obtener_marcas($conexion) {
    $sql = "SELECT * FROM marcas";
    $resultado = mysqli_query($conexion, $sql);
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

function obtener_marca_id($id_marca, $conexion) {
    $sql = "SELECT * FROM marcas WHERE id_marca = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_marca);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($resultado);
}

function insertar_marca($conexion, $nombre, $pais) {
    $sql = "INSERT INTO marcas (nombre, pais) VALUES (?, ?)";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $nombre, $pais);
    return mysqli_stmt_execute($stmt);
}

function editar_marca($conexion, $id_marca, $nombre, $pais) {
    $sql = "UPDATE marcas SET nombre = ?, pais = ? WHERE id_marca = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $nombre, $pais, $id_marca);
    return mysqli_stmt_execute($stmt);
}

function eliminar_marca($conexion, $id_marca) {
    $sql = "DELETE FROM marcas WHERE id_marca = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_marca);
    return mysqli_stmt_execute($stmt);
}