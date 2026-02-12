<?php
session_start(); 
require_once 'db.php';
require_once 'funciones_usuarios.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = trim($_POST['password']);

    $usuario = verificar_login($conexion, $email, $password);
    mysqli_close($conexion);

    var_dump($usuario); // Agrega esta línea para depurar el resultado de la función verificar_login

    if ($usuario) {
        // Login correcto: guardamos los datos del usuario en la sesión
        $_SESSION['id_usuario'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];

        header('Location: panel.php');
        exit;
    } else {

        //Login incorrecto: redirigimos al login con un mensaje de error
        $_SESSION['msg'] = "Usuario o contraseña incorrectos.";
        header('Location: login.php');
        exit;
    }
}