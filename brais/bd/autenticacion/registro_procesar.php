<?php
session_start();
require_once 'db.php';
require_once 'funciones_usuarios.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $usuario_existente = obtener_usuario_por_usuario($conexion, $usuario);
    if ($usuario_existente) {
        $msg = "El usuario ya está registrado.";
        $_SESSION['msg'] = $msg;
        header('Location: registro.php');
        exit;
    } else {
        $registro = registrar_usuario($conexion, $nombre, $usuario, $password);
        mysqli_close($conexion);

        if ($registro) {
            $msg = "Usuario registrado correctamente. Por favor, inicie sesión.";
            $_SESSION['msg'] = $msg;
            header('Location: login.php');
            exit;
        } else {
            $msg = "Error al registrar el usuario.";
            $_SESSION['msg'] = $msg;
            header('Location: registrar.php');
            exit;
        }
    }
}
