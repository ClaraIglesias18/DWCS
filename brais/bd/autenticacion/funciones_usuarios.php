<?php
function obtener_usuario_id($idusuario, $conexion) {
    $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idusuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($resultado);
}

function registrar_usuario($conexion, $nombre, $usuario, $password) {
    $password_segura = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, usuario, password) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $nombre, $usuario, $password_segura);
    return mysqli_stmt_execute($stmt);
}

function obtener_usuario_por_usuario($conexion, $usuario) {
    $sql = "SELECT * FROM usuarios WHERE usuario = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($resultado);
}

function verificar_login($conexion, $usuario, $password) {
    $sql = "SELECT * FROM usuarios WHERE usuario = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    $usuario = mysqli_fetch_assoc($resultado);
    
    if ($usuario && password_verify($password, $usuario['password'])) {
        return $usuario;
    } else {
        return false;
    }
}