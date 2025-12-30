<?php
session_start();
require_once 'funciones.php';

// ------ GESITON DE PETICIONES POST ------

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = conectar_db();

    // Conexion a base de datos

    $conexion = conectar_db();
    if (!$conexion) {
        $mensaje = "ERROR: No se pudo conectar a la base de datos.";
        header('Location: cartelera.php?mensaje=' . $mensaje);
        exit();
    }

    // Insercion de usuarios

    if (isset($_POST['accion']) && $_POST['accion'] == 'registrar') {
        $usuario = $_POST['usuario'];
        $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

        if (obtener_usuario_por_nombre($conexion, $usuario)) {
            $mensaje = "El nombre de usuario ya está en uso.";
            cerrar_db($conexion);
            header('Location: registro.php?mensaje=' . $mensaje);
        } else {
            if (isset($usuario) && isset($password)) {
                if (insertar_usuario($conexion, $usuario, $password)) {
                    $mensaje = "Usuario registrado con exito!";
                } else {
                    $mensaje = "Error al registrar usuario";
                }
            }
        }

        cerrar_db($conexion);
        header('Location: login.php?mensaje=' . $mensaje);
        exit();
    }

    // Validacion de usuario

    if (isset($_POST['accion']) && $_POST['accion'] == 'login') {
        $usuario = $_POST['user'];
        $password = $_POST['pass'];

        $usuario_bd = obtener_usuario_por_nombre($conexion, $usuario);

        if ($usuario_bd && password_verify($password, $usuario_bd['password'])) {
            // Credenciales correctas
            $_SESSION['usuario_id'] = $usuario_bd['id'];
            $_SESSION['usuario_nombre'] = $usuario_bd['username'];
            cerrar_db($conexion);
            header('Location: cartelera.php');
            exit();
        } else {
            // Credenciales incorrectas
            $mensaje = "Usuario o contraseña incorrectos.";
            cerrar_db($conexion);
            header('Location: login.php?mensaje=' . $mensaje);
            exit();
        }
    }

    // Insercion de valoraciones

    if (isset($_POST['accion']) && $_POST['accion'] == 'valorar') {
        $id_usuario = $_POST['usuario_id'];
        $id_pelicula = $_POST['id_pelicula'];
        $comentario = $_POST['comentario'];
        $estrellas = $_POST['estrellas'];

        if (empty($estrellas) || empty($comentario)) {
            $mensaje = "ERROR: Debes completar todos los campos para enviar tu valoración.";
        } else {
            if (insertar_valoracion($conexion, $id_usuario, $id_pelicula, $comentario, $estrellas)) {
                $mensaje = "Valoración insertada con exito!";
            } else {
                $mensaje = "Error al insertar valoración";
            }
        }

        cerrar_db($conexion);
        header('Location: ficha.php?id=' . $id_pelicula . '&mensaje=' . $mensaje);
        exit();
    }
    //cerrar_db($conexion);
}
