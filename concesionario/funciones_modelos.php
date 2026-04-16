<?php

function obtener_modelos($conexion) {
    $sql = "SELECT mo.*, ma.nombre AS nombre_marca FROM modelos mo JOIN marcas ma ON mo.id_marca = ma.id_marca";
    $resultado = mysqli_query($conexion, $sql);
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

function obtener_modelo_id($id_modelo, $conexion) {
    $sql = "SELECT * FROM modelos WHERE id_modelo = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_modelo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($resultado);
}

function insertar_modelo($conexion, $nombre, $anio, $id_marca) {
    $sql = "INSERT INTO modelos (nombre, anio, id_marca) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sii", $nombre, $anio, $id_marca);
    return mysqli_stmt_execute($stmt);
}

function editar_modelo($conexion, $id_modelo, $nombre, $anio, $id_marca) {
    $sql = "UPDATE modelos SET nombre = ?, anio = ?, id_marca = ? WHERE id_modelo = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "siii", $nombre, $anio, $id_marca, $id_modelo);
    return mysqli_stmt_execute($stmt);
}


function eliminar_modelo($conexion, $id_modelo) {
    $sql = "DELETE FROM modelos WHERE id_modelo = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_modelo);
    return mysqli_stmt_execute($stmt);
}