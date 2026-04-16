<?php
function obtener_usuario_id($id_usuario, $conexion) {
    $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($resultado);
}

function registrar_usuario($conexion, $nombre_usuario, $email, $password) {

    $sql = "INSERT INTO usuarios (nombre_usuario, email, password) VALUES (?, ?, ?)";

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $nombre_usuario, $email, $password_hash);
    return mysqli_stmt_execute($stmt);
}

function obtener_usuario_por_email($conexion, $email) {
    $sql = "SELECT * FROM usuarios WHERE email = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($resultado);
}

function verificar_login($conexion, $email, $password) {
    $sql = "SELECT * FROM usuarios WHERE email = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    $usuario = mysqli_fetch_assoc($resultado);
    
    if ($usuario && password_verify($password, $usuario['password'])) {
        return $usuario;
    } else {
        return false;
    }
}