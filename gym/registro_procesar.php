<?php
session_start();
require_once 'db.php';
require_once 'funciones_usuarios.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = $_POST['rol']; // 'ADMIN' o 'NORMAL'

    // Aquí puedes agregar la lógica para guardar los datos en una base de datos
    // Por ejemplo, usando PDO para conectarte a una base de datos MySQL

    $usuario_existente = obtener_usuario_por_email($conexion, $email);
    if ($usuario_existente) {
        $msg = "El email ya está registrado.";
        $_SESSION['msg'] = $msg;
        header('Location: registro.php');
        exit;
    } else {
        $registro = registrar_usuario($conexion, $nombre, $email, $password, $rol);
        mysqli_close($conexion);

        if ($registro) {
            $msg = "Usuario registrado correctamente. Por favor, inicie sesión.";
            $_SESSION['msg'] = $msg;
            header('Location: login.php');
            exit;
        } else {
            $msg = "Error al registrar el usuario.";
            $_SESSION['msg'] = $msg;
            header('Location: registro.php');
            exit;
        }
    }
}
