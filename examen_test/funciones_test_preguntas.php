<?php
function añadir_preguntas_test($conexion, $id_test, $id_pregunta) {
    $sql = "INSERT INTO test_preguntas(id_test, id pregunta) VALUES (? , ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id_test, $id_pregunta);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

function obtener_preguntas_test($conexion, $id_test) {
    $sql = "SELECT * FROM preguntas p JOIN test_preguntas t ON p.id_pregunta = t.id_pregunta where id_test = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_test);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $preguntas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $preguntas;
}

