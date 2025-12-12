<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'abc123.');
define('DB_NAME', 'tienda');


function conectar_db() {
    $conexion = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
        return false;
    }

    // Opcional: Establecer el juego de caracteres (importante para tildes y eñes)
    $conexion->set_charset("utf8mb4");

    return $conexion;
}

function obtener_productos($conexion) {
    $sql = "SELECT * FROM productos";

    $resultado = $conexion->query($sql);

    if ($resultado === false) {
        error_log("Error en la consulta: " . $conexion->error);
        return false;
    }

    $productos = [];
    while ($fila = $resultado->fetch_assoc()) {
        $productos[] = $fila;
    }

    return $productos;
}

function insertar_producto($conexion, $nombre, $precio) {

    $sql = "INSERT INTO productos (nombre, precio) VALUES (?, ?)";
    $stm = $conexion->prepare($sql);

    if ($stm === false) {
        error_log("Error al preparar la sentencia: " . $conexion->error);
        return false;
    }

    $stm->bind_param("sd", $nombre, $precio);
    $resultado = $stm->execute();
    $stm->close();
    return $resultado;
}

function borrar_producto($conexion, $id) {
    $sql = "DELETE FROM productos WHERE id = ?";

    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        error_log("Error al preparar la sentencia DELETE: " . $conexion->error);
        return false;
    }

    $id_entero = (int)$id; 
    $stmt->bind_param("i", $id_entero);

    $resultado = $stmt->execute();

    $stmt->close();

    return $resultado;
}


function cerrar_db($conexion) {
    if ($conexion) {
        $conexion->close();
    }
}
?>