<?php

function crear_test($conexion, $titulo) {
    $sql = "INSERT INTO tests (titulo) VALUES (?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $titulo);
    mysqli_stmt_execute($stmt);
    $id_test = mysqli_insert_id($conexion);
    mysqli_stmt_close($stmt);
    return $id_test;
}

function obtener_tests($conexion) {
    $sql = "SELECT * FROM tests";
    $resultado = mysqli_query($conexion, $sql);
    $tests = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    return $tests;
}

function obtener_test_id($conexion, $id_test) {
    $sql = "SELECT * FROM tests WHERE id_test = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_test);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $test = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);
    return $test;
}

function eliminar_test($conexion, $id_test) {
    $sql = "DELETE FROM tests WHERE id_test = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_test);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

function actualizar_test($conexion, $id_test, $titulo) {
    $sql = "UPDATE tests SET titulo = ? WHERE id_test = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "si", $titulo, $id_test);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

