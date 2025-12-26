<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'abc123.');
define('DB_NAME', 'tienda');


function conectar_db() {
    $conexion = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if (mysqli_connect_errno()) {
        return false;
    }

    return $conexion;
}

function obtener_usuarios($conexion) {
    $sql = "SELECT * precio FROM usuarios";

    $resultado = mysqli_query($conexion, $sql);

    if ($resultado == false) {
        return false;
    }

    $usuarios = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $usuarios[] = $fila;
    }

    return $usuarios;
}

function insertar_usuario($conexion, $nombre, $apellidos, $correo, $contraseña, $tipo) {
    $sql = "INSERT INTO usuarios (nombre, apellidos, correo, contraseña, tipo) VALUES (?, ?, ?, ?, ?)";

    $pass_encriptada = password_hash($contraseña, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt == false) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "sssss", $nombre, $apellidos, $correo, $pass_encriptada, $tipo);

    $resultado = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $resultado;
}

function obtener_usuario_por_id($conexion, $id) {
    $sql = "SELECT id, nombre, apellidos, correo, contraseña FROM usuarios WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    if ($stmt == false) {
        return false;
    }

    $id_entero = (int)$id;
    mysqli_stmt_bind_param($stmt, "i", $id_entero);

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado && mysqli_num_rows($resultado) === 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        mysqli_stmt_close($stmt);
        return $usuario;
    }

    mysqli_stmt_close($stmt);
    return false;
}

function obtener_usuario_por_correo($conexion, $correo) {
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $correo);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $usuario = mysqli_fetch_assoc($resultado);
        mysqli_stmt_close($stmt);
        return $usuario;
    }
    return false;
}

function cerrar_db($conexion) {
    if ($conexion) {
        mysqli_close($conexion);
    }
}
?>