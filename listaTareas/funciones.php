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

// FUNCIONES PARA GETIONAR TAREAS

function obtener_tareas($conexion, $id_usuario) {
    $sql = "SELECT * FROM tareas where usuario_id = ?";

    
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt == false) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $id_usuario);

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado == false) {
        return false;
    }

    $tareas = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $tareas[] = $fila;
    }

    return $tareas;
}

function insertar_tarea($conexion, $titulo, $completada, $fecha_creacion, $id_usuario) {
    $sql = "INSERT INTO tareas (titulo, completada, fecha_creacion, usuario_id) VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt == false) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "sisi", $titulo, $completada, $fecha_creacion, $id_usuario);

    $resultado = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $resultado;
}

function eliminar_tarea($conexion, $id) {
    $sql = "DELETE FROM tareas WHERE id = ?";

    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt == false) {
        return false;
    }

    $id_entero = (int)$id;
    mysqli_stmt_bind_param($stmt, "i", $id_entero);

    $resultado = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $resultado;
}

function obtener_tarea_por_id($conexion, $id) {
    $sql = "SELECT id, titulo, completada, fecha_creacion FROM tareas WHERE id = ?";
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

function actualizar_tarea($conexion, $id, $titulo, $completada) {
    $sql = "UPDATE tareas SET titulo = ?, completada = ? WHERE id = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    if ($stmt == false) {
        return false;
    }

    $id_entero = (int)$id;
    mysqli_stmt_bind_param($stmt, "sii", $titulo, $completada, $id_entero); 

    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $resultado;
}

// FUNCIONES PARA GESTIONAR USUARIOS

function insertar_usuario($conexion, $usuario, $password) {
    $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";

    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt == false) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ss", $usuario, $password);

    $resultado = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $resultado;
}

function obtener_usuario_por_nombre($conexion, $usuario) {
    $sql = "SELECT id, username, password FROM usuarios WHERE username = ?";

    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt == false) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "s", $usuario);

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

function cerrar_db($conexion) {
    if ($conexion) {
        mysqli_close($conexion);
    }
}
?>