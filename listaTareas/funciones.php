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

function obtener_tareas($conexion) {
    $sql = "SELECT * FROM tareas";

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

function insertar_tarea($conexion, $titulo, $completada, $fecha_creacion) {
    $sql = "INSERT INTO tareas (titulo, completada, fecha_creacion) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt == false) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "sis", $titulo, $completada, $fecha_creacion);

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

function cerrar_db($conexion) {
    if ($conexion) {
        mysqli_close($conexion);
    }
}
?>