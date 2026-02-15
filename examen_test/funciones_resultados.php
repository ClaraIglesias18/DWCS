<?php
function obtener_resultados_usuario($conexion, $id_usuario) {
    $sql = "SELECT r.id_resultado, t.titulo, r.fecha, r.aciertos, r.total_preguntas FROM resultados r JOIN tests t ON r.id_test = t.id_test WHERE r.id_usuario = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function guardar_resultado($conexion, $id_usuario, $id_test, $aciertos, $total_preguntas) {
    $sql = "INSERT INTO resultados (id_usuario, id_test, aciertos, total_preguntas) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "iiii", $id_usuario, $id_test, $aciertos, $total_preguntas);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}