<?php

function insertar_incidencia($conexion, $usuario_id, $titulo, $descripcion, $prioridad, $estado) {
    $sql = "INSERT INTO incidencias(usuario_id, titulo, descripcion, prioridad, estado) VALUES(?, ?, ?, ? , 'Abierta')";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "isss", $usuario_id, $titulo, $descripcion, $prioridad);
    return mysqli_stmt_execute($stmt);
}

function obtener_incidencias($conexion) {
    $sql = "SELECT i.id, i.titulo, i.prioridad, i.estado, i.fecha_creacion, u.nombre AS empleado_nombre
        	FROM incidencias i
       	    INNER JOIN usuarios u ON i.usuario_id = u.id
      	    ORDER BY i.fecha_creacion DESC";
    $resultado = mysqli_query($conexion, $sql);
    $incidencias = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    return $incidencias;
}

function obtener_incidencia_empleado($conexion, $usuario_id) {
    $sql = "SELECT * FROM incidencias WHERE usuario_id = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $usuario_id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $incidencias = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);

    return $incidencias;
}

function modificar_estado($conexion, $id_incidencia, $estado) {
    $sql = "UPDATE incidencias SET estado = ? WHERE id = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "si", $estado, $id_incidencia);
    return mysqli_stmt_execute($stmt);
}
