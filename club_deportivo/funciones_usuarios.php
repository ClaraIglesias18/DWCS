<?php
// 1. FUNCIÓN PARA REGISTRAR UN NUEVO JUGADOR
function registrar_usuario($conexion, $username, $password, $nivel) {
    // Limpiamos los datos para evitar espacios accidentales
    $username = trim($username);
    $password = trim($password);
    
    // HASHEAMOS la contraseña (Esto genera la cadena de 60+ caracteres)
    $password_segura = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO usuarios (username, password, nivel) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    
    // "sss" significa que enviamos 3 strings (cadenas de texto)
    mysqli_stmt_bind_param($stmt, "sss", $username, $password_segura, $nivel);
    
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    return $resultado;
}

// 2. FUNCIÓN PARA VERIFICAR LOGIN
function verificar_login($conexion, $username, $password_plana) {
    $username = trim($username);
    
    // Buscamos al usuario por su nombre
    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    
    $resultado = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);

    // Si el usuario existe, comparamos la contraseña plana con el HASH de la BDD
    if ($usuario && password_verify(trim($password_plana), $usuario['password'])) {
        return $usuario; // Login correcto: devolvemos los datos del usuario
    } else {
        return false; // Login incorrecto
    }
}

// 3. FUNCIÓN PARA OBTENER LOS DATOS DE UN USUARIO POR SU ID
function obtener_usuario_por_id($conexion, $id_usuario) {
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_usuario); // "i" porque el ID es un entero
    mysqli_stmt_execute($stmt);
    
    $resultado = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);
    
    return $usuario;
}
?>