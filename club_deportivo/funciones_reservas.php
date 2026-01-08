<?php

// 1. FUNCIÓN PARA COMPROBAR SI UNA PISTA ESTÁ LIBRE
function esta_pista_disponible($conexion, $id_pista, $fecha, $hora) {
    $sql = "SELECT id FROM reservas WHERE id_pista = ? AND fecha = ? AND hora = ? AND estado != 'Cancelada'";
    
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "iss", $id_pista, $fecha, $hora);
    mysqli_stmt_execute($stmt);
    
    $resultado = mysqli_stmt_get_result($stmt);
    
    // Si hay 0 filas, significa que está libre
    return mysqli_num_rows($resultado) === 0;
}

// 2. FUNCIÓN PARA CREAR LA RESERVA
function crear_reserva($conexion, $id_usuario, $id_pista, $fecha, $hora) {
    $sql = "INSERT INTO reservas (id_usuario, id_pista, fecha, hora) VALUES (?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "iiss", $id_usuario, $id_pista, $fecha, $hora);
    
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    return $resultado;
}

/**
 * Obtiene una lista de horas ya reservadas para una pista y fecha concreta
 */
function obtener_horas_ocupadas($conexion, $id_pista, $fecha) {
    $horas_ocupadas = [];
    
    $sql = "SELECT hora FROM reservas WHERE id_pista = ? AND fecha = ? AND estado != 'Cancelada'";
    
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "is", $id_pista, $fecha);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    while($fila = mysqli_fetch_assoc($res)) {
        // El formato TIME de MySQL es HH:MM:SS, lo recortamos a HH:MM
        $horas_ocupadas[] = substr($fila['hora'], 0, 5);
    }
    
    mysqli_stmt_close($stmt);
    return $horas_ocupadas;
}

// 3. FUNCIÓN PARA OBTENER LAS RESERVAS DE UN USUARIO (CON EL NOMBRE DE LA PISTA)
function obtener_reservas_usuario($conexion, $id_usuario) {
    // Usamos JOIN para traer el nombre de la pista desde la tabla 'pistas'
    $sql = "SELECT r.*, p.nombre as nombre_pista, p.tipo 
            FROM reservas r
            JOIN pistas p ON r.id_pista = p.id
            WHERE r.id_usuario = ?
            ORDER BY r.fecha ASC, r.hora ASC";
            
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    mysqli_stmt_execute($stmt);
    
    $resultado = mysqli_stmt_get_result($stmt);
    
    // Devolvemos todas las filas como un array asociativo
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

// 4. FUNCIÓN PARA CANCELAR (BORRAR O ACTUALIZAR ESTADO)
function cancelar_reserva($conexion, $id_reserva, $id_usuario) {
    // Es vital pedir el id_usuario para que nadie pueda borrar reservas de otros por URL
    $sql = "DELETE FROM reservas WHERE id = ? AND id_usuario = ?";
    
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id_reserva, $id_usuario);
    
    return mysqli_stmt_execute($stmt);
}