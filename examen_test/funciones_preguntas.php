<?php

function crear_pregunta($conexion, $id_test, $enunciado, $op_a, $op_b, $op_c, $correcta) {
    $sql = "INSERT INTO preguntas (id_test, enunciado, op_a, op_b, op_c, correcta) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "isssss", $id_test, $enunciado, $op_a, $op_b, $op_c, $correcta);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

function obtener_preguntas($conexion, $id_test) {
    $sql = "SELECT * FROM preguntas WHERE id_test = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_test);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $preguntas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $preguntas;
}

function obtener_preguntas_correctas($conexion, $id_test) {
    $sql = "SELECT id_pregunta, correcta FROM preguntas WHERE id_test = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_test);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $preguntas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $preguntas;
}

function obtener_pregunta_id($conexion, $id_pregunta) {
    $sql = "SELECT * FROM preguntas WHERE id_pregunta = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_pregunta);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $pregunta = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);
    return $pregunta;
}

function actualizar_pregunta($conexion, $id_pregunta, $enunciado, $op_a, $op_b, $op_c, $correcta) {
    $sql = "UPDATE preguntas SET enunciado = ?, op_a = ?, op_b = ?, op_c = ?, correcta = ? WHERE id_pregunta = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $enunciado, $op_a, $op_b, $op_c, $correcta, $id_pregunta);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}