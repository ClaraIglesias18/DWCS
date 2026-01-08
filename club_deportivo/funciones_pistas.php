<?php
function obtener_todas_las_pistas($conexion) {
    $sql = "SELECT * FROM pistas";
    $resultado = mysqli_query($conexion, $sql);
    
    // Convertimos el resultado en un array fácil de usar
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}