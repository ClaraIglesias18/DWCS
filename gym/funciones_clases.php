<?php

function crear_clase($conexion, $actividad, $dia_semana, $hora, $cupo_maximo) {
    $sql = "INSERT INTO clases (actividad, dia_semana, hora, cupo_maximo) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $actividad, $dia_semana, $hora, $cupo_maximo);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

function eliminar_clase($conexion, $id_clase) {
    $sql = "DELETE FROM clases WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_clase);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

function obtener_clases($conexion) {
    $sql = "SELECT * FROM clases";
    $resultado = mysqli_query($conexion, $sql);
    $clases = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    return $clases;
}

function obtener_cupo($conexion, $id_clase) {
    $sql = "SELECT cupo_maximo FROM clases WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_clase);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $cupo = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);
    return $cupo['cupo_maximo'];
}

function obtener_clase_id($conexion, $id_clase) {
    $sql = "SELECT * FROM clases WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_clase);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $clase = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);
    return $clase;
}

function editar_clase($conexion, $id_clase, $actividad, $hora, $dia_semana, $cupo_maximo) {
    $sql = "UPDATE clases SET actividad = ?, dia_semana = ?, hora = ?, cupo_maximo = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sssii", $actividad, $dia_semana, $hora, $cupo_maximo, $id_clase);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}
