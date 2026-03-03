<?php
session_start(); 
require_once 'db.php';
require_once 'funciones_usuarios.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $usuario = verificar_login($conexion, $usuario, $password);
    mysqli_close($conexion); // Agrega esta línea para depurar el resultado de la función verificar_login

    if ($usuario) {
        // Login correcto: guardamos los datos del usuario en la sesión
        $_SESSION['usuario'] = $usuario['nombre'];

        header('Location: privado.php');
        exit;
    } else {

        //Login incorrecto: redirigimos al login con un mensaje de error
        $_SESSION['msg'] = "Usuario o contraseña incorrectos.";
        header('Location: login.php');
        exit;
    }
}