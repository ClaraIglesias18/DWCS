<?php
// 1. FUNCIÓN PARA REGISTRAR UN NUEVO USUARIO
function registrar_usuario($conexion, $username, $password, $nombre, $rol) {
    // Limpiamos los datos básicos
    $username = trim($username);
    $password = trim($password);
    $nombre = trim($nombre);
    
    // Hasheamos la contraseña por seguridad mínima
    $password_segura = password_hash($password, PASSWORD_DEFAULT);
    
    // Pasamos las variables directamente a la cadena SQL
    // IMPORTANTE: Las variables de texto deben ir entre comillas simples ''
    $sql = "INSERT INTO usuarios (username, password, nombre, rol) 
            VALUES ('$username', '$password_segura', '$nombre', '$rol')";
    
    // Ejecutamos la consulta directamente
    $resultado = mysqli_query($conexion, $sql);
    
    return $resultado;
}

// 2. FUNCIÓN PARA VERIFICAR LOGIN
function verificar_login($conexion, $username, $password_plana) {
    $username = trim($username);
    
    // Pasamos la variable directamente a la consulta SQL entre comillas simples
    $sql = "SELECT * FROM usuarios WHERE username = '$username'";
    
    // Ejecutamos la consulta a pelo
    $resultado = mysqli_query($conexion, $sql);
    
    // Obtenemos el registro (si existe)
    $usuario = mysqli_fetch_assoc($resultado);

    // Verificamos si encontramos al usuario y si la contraseña coincide con el hash
    if ($usuario && password_verify(trim($password_plana), $usuario['password'])) {
        return $usuario; // Login correcto: devolvemos los datos del usuario (id, nombre, rol, etc.)
    } else {
        return false; // Login incorrecto
    }
}

// 3. FUNCIÓN PARA OBTENER LOS DATOS DE UN USUARIO POR SU ID
function obtener_usuario_por_id($conexion, $id_usuario) {
    // Pasamos la variable directamente a la cadena SQL
    // Al ser un valor numérico, no es estrictamente necesario poner comillas, 
    // pero se pueden usar para mayor consistencia.
    $sql = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";
    
    // Ejecutamos la consulta a pelo
    $resultado = mysqli_query($conexion, $sql);
    
    // Extraemos el registro
    $usuario = mysqli_fetch_assoc($resultado);
    
    return $usuario;
}
?>