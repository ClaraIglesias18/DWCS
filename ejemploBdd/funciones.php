<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'abc123.');
define('DB_NAME', 'tienda');


function conectar_db() {
    // Uso de la función mysqli_connect()
    $conexion = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Comprobar la conexión (usando funciones procedurales)
    if (mysqli_connect_errno()) {
        die("Error de conexión a la base de datos: " . mysqli_connect_error());
        return false;
    }

    // Opcional: Establecer el juego de caracteres
    mysqli_set_charset($conexion, "utf8mb4");

    return $conexion;
}

function obtener_productos($conexion) {
    $sql = "SELECT id, nombre, precio FROM productos";

    // Ejecutar la consulta con mysqli_query()
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado === false) {
        // Obtener el error usando función procedural
        error_log("Error en la consulta: " . mysqli_error($conexion));
        return false;
    }

    // Recoger todos los resultados usando mysqli_fetch_assoc()
    $productos = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $productos[] = $fila;
    }

    // Liberar la memoria del resultado (Procedural)
    mysqli_free_result($resultado);

    return $productos;
}

function insertar_producto($conexion, $nombre, $precio) {
    $sql = "INSERT INTO productos (nombre, precio) VALUES (?, ?)";

    // 1. Preparar la sentencia (Procedural)
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt === false) {
        error_log("Error al preparar la sentencia: " . mysqli_error($conexion));
        return false;
    }

    // 2. Vincular los parámetros (Procedural)
    // Usamos el paso "sd" (string, double)
    mysqli_stmt_bind_param($stmt, "sd", $nombre, $precio);

    // 3. Ejecutar la sentencia (Procedural)
    $resultado = mysqli_stmt_execute($stmt);

    // 4. Cerrar la sentencia (Procedural)
    mysqli_stmt_close($stmt);

    return $resultado;
}

function borrar_producto($conexion, $id) {
    // 1. Definir la consulta SQL
    $sql = "DELETE FROM productos WHERE id = ?";

    // 2. Preparar la sentencia (Procedural)
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt === false) {
        error_log("Error al preparar la sentencia DELETE: " . mysqli_error($conexion));
        return false;
    }

    // 3. Vincular el parámetro (Procedural). El ID es un entero ('i').
    $id_entero = (int)$id;
    mysqli_stmt_bind_param($stmt, "i", $id_entero);

    // 4. Ejecutar la sentencia (Procedural)
    $resultado = mysqli_stmt_execute($stmt);

    // 5. Cerrar la sentencia (Procedural)
    mysqli_stmt_close($stmt);

    return $resultado;
}

function obtener_producto_por_id($conexion, $id) {
    $sql = "SELECT id, nombre, precio FROM productos WHERE id = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    if ($stmt === false) {
        error_log("Error al preparar la sentencia SELECT: " . mysqli_error($conexion));
        return false;
    }

    $id_entero = (int)$id;
    // 1. Vincular el ID (entero)
    mysqli_stmt_bind_param($stmt, "i", $id_entero);

    // 2. Ejecutar la sentencia
    mysqli_stmt_execute($stmt);

    // 3. Obtener el resultado
    $resultado = mysqli_stmt_get_result($stmt);

    // 4. Si hay resultado, obtener la fila (solo debería haber una)
    if ($resultado && mysqli_num_rows($resultado) === 1) {
        $producto = mysqli_fetch_assoc($resultado);
        mysqli_free_result($resultado);
        mysqli_stmt_close($stmt);
        return $producto;
    }

    mysqli_stmt_close($stmt);
    return false;
}

function actualizar_producto($conexion, $id, $nombre, $precio) {
    // La consulta requiere un WHERE id = ?
    $sql = "UPDATE productos SET nombre = ?, precio = ? WHERE id = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    if ($stmt === false) {
        error_log("Error al preparar la sentencia UPDATE: " . mysqli_error($conexion));
        return false;
    }

    $id_entero = (int)$id;
    // Vinculación: dos strings (nombre, precio) y un entero (id). El precio decimal se trata como string ('s') o double ('d'). Usaremos 'sd'.
    // ¡IMPORTANTE! El orden debe coincidir con el orden de los '?' en la consulta.
    mysqli_stmt_bind_param($stmt, "sdi", $nombre, $precio, $id_entero); 

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