<?php

function reservar($conexion, $id_clase, $id_usuario) {
    $sql = "INSERT INTO reservas (clase_id, usuario_id) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id_clase, $id_usuario);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

function obtener_reservas_usuario($conexion, $id_usuario) {
    $sql = "SELECT r.id, c.actividad, c.dia_semana, c.hora FROM reservas r JOIN clases c ON r.clase_id = c.id WHERE r.usuario_id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $reservas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $reservas;
}

function obtener_reserva_id($conexion, $id_clase, $id_usuario) {
    $sql = "SELECT * FROM reservas WHERE clase_id = ? AND usuario_id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id_clase, $id_usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $reserva = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);
    return $reserva;
}

function contar_reservas($conexion, $id_clase) {
    $sql = "SELECT COUNT(*) AS total FROM reservas WHERE clase_id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_clase);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $total_reservas = mysqli_fetch_assoc($resultado)['total'];
    mysqli_stmt_close($stmt);
    return $total_reservas;
}

function cancelar_reserva($conexion, $id_reserva) {
    $sql = "DELETE FROM reservas WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_reserva);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}
