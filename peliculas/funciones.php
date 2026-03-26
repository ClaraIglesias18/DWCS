<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'abc123.');
define('DB_NAME', 'biblioteca_cine');


function conectar_db() {
    $conexion = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if (mysqli_connect_errno()) {
        return false;
    }

    return $conexion;
}

// ------- FUNCIONES PARA GESTIONAR PELICULAS -------

function obtener_peliculas($conexion) {
    $sql = "SELECT * FROM peliculas";

    $resultado = mysqli_query($conexion, $sql);

    if ($resultado == false) {
        return false;
    }

    $peliculas = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $peliculas[] = $fila;
    }

    return $peliculas;
}

function obtener_pelicula_por_id($conexion, $id) {
    $sql = "SELECT *FROM peliculas WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    if ($stmt == false) {
        return false;
    }

    $id_entero = (int)$id;
    mysqli_stmt_bind_param($stmt, "i", $id_entero);

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado && mysqli_num_rows($resultado) === 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        mysqli_stmt_close($stmt);
        return $usuario;
    }

    mysqli_stmt_close($stmt);
    return false;
}

// ------- FUNCIONES PARA GESTIONAR VALORACIONES  -------

function insertar_valoracion($conexion, $id_usuario, $id_pelicula, $comentario, $estrellas) {
    $sql = "INSERT INTO valoraciones (id_usuario, id_pelicula, comentario, estrellas) VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt == false) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "iisi", $id_usuario, $id_pelicula, $comentario, $estrellas);

    $resultado = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $resultado;
}

function obtener_valoraciones_por_pelicula($conexion, $id_pelicula) {
    $sql = "SELECT v.comentario, v.estrellas, u.username FROM valoraciones v JOIN usuarios u ON v.id_usuario = u.id WHERE v.id_pelicula = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    if ($stmt == false) {
        return false;
    }

    $id_entero = (int)$id_pelicula;
    mysqli_stmt_bind_param($stmt, "i", $id_entero);

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado == false) {
        mysqli_stmt_close($stmt);
        return false;
    }

    $valoraciones = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $valoraciones[] = $fila;
    }

    mysqli_stmt_close($stmt);
    return $valoraciones;
}

// ------- FUNCIONES PARA GESTIONAR USUARIOS  -------

function insertar_usuario($conexion, $usuario, $password) {
    $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";

    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt == false) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ss", $usuario, $password);

    $resultado = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $resultado;
}

function obtener_usuario_por_nombre($conexion, $usuario) {
    $sql = "SELECT id, username, password FROM usuarios WHERE username = ?";

    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt == false) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "s", $usuario);

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado && mysqli_num_rows($resultado) === 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        mysqli_stmt_close($stmt);
        return $usuario;
    }

    mysqli_stmt_close($stmt);
    return false;
}

function cerrar_db($conexion) {
    if ($conexion) {
        mysqli_close($conexion);
    }
}
