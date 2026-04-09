<?php

// ---------- USUARIOS -----------

function obtener_usuario_id($idusuario, $conexion) {
    $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idusuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($resultado);
}

function registrar_usuario($conexion, $nombre, $email, $password) {
    $password_segura = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $nombre, $email, $password_segura);
    return mysqli_stmt_execute($stmt);
}

function obtener_usuario_por_email($conexion, $email) {
    $sql = "SELECT * FROM usuarios WHERE email = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($resultado);
}

function verificar_login($conexion, $email, $password) {
    $sql = "SELECT * FROM usuarios WHERE email = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    $usuario = mysqli_fetch_assoc($resultado);
    
    if ($usuario && password_verify($password, $usuario['password'])) {
        return $usuario;
    } else {
        return false;
    }
}

// --------- PRODUCTOS ----------

function obtener_productos($conexion, $categoria = null) {
    // 1. Base de la consulta
    $sql = "SELECT * FROM productos";
    
    // 2. Si hay categoría, añadimos el WHERE
    if ($categoria !== null) {
        $sql .= " WHERE categoria = ?";
    }

    $stmt = mysqli_prepare($conexion, $sql);

    // 3. Si hay categoría, vinculamos el parámetro
    if ($categoria !== null) {
        mysqli_stmt_bind_param($stmt, "s", $categoria);
    }

    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

function obtener_productos_por_usuario($conexion, $usuario_id) {
    $sql = "SELECT * FROM productos WHERE vendedor_id = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $usuario_id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

function obtener_producto_por_id($conexion, $id_producto) {
    $sql = "SELECT * FROM productos WHERE id = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_producto);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    return mysqli_fetch_assoc($resultado);
}

function insertar_productos($conexion, $usuario_id, $nombre, $descripcion, $precio, $imagen,  $categoria, $estado) {
    $sql = "INSERT INTO productos (vendedor_id, nombre, descripcion, precio, imagen, categoria, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "issdsss", $usuario_id, $nombre, $descripcion, $precio, $imagen,  $categoria, $estado);
    return mysqli_stmt_execute($stmt);
}

function eliminar_producto($conexion, $id_producto) {
    $sql = "DELETE FROM productos WHERE id = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_producto);
    return mysqli_stmt_execute($stmt);
}

function editar_producto($conexion, $id_producto, $nombre, $descripcion, $precio, $imagen, $categoria, $estado) {
    $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, imagen = ?, categoria = ?, estado = ? WHERE id = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ssdsssi", $nombre, $descripcion, $precio, $imagen,  $categoria, $estado, $id_producto);
    return mysqli_stmt_execute($stmt);
}

// ----------- FAVORITOS ----------

function insertar_favorito($conexion, $id_producto, $id_usuario) {
    $sql = "INSERT INTO favoritos(usuario_id, producto_id) VALUES(?, ?)";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_producto);

    return mysqli_stmt_execute($stmt);
}

function comprobar_favorito($conexion, $id_producto, $id_usuario) {
    $sql = "SELECT * FROM favoritos where usuario_id = ? AND producto_id = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_producto);

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($resultado);

}

function obtener_favoritos($conexion, $id_usuario) {
    $sql = "SELECT * FROM productos p JOIN favoritos f ON p.id = f.producto_id WHERE usuario_id = ?;";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_usuario);

    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

function eliminar_favorito($conexion, $id_producto, $id_usuario) {
    $sql = "DELETE FROM favoritos WHERE producto_id = ? AND usuario_id = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id_producto, $id_usuario);

    return mysqli_stmt_execute($stmt);
}



