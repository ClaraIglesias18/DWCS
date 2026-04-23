<?php
function obtener_todas_las_pistas($conexion) {
    $sql = "SELECT * FROM pistas";
    $resultado = mysqli_query($conexion, $sql);
    
    // Convertimos el resultado en un array fácil de usar
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

function obtener_pista_id($conexion, $id_pista) {
    $sql = "SELECT * FROM pistas WHERE id = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_pista);
    mysqli_stmt_execute($stmt);
    
    $resultado = mysqli_stmt_get_result($stmt);
    $pista = mysqli_fetch_assoc($resultado);

    return $pista;
}