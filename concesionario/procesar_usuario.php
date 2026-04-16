<?php
session_start();
require_once('db.php');
require_once('funciones_usuario.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if($_POST['accion'] && $_POST['accion'] == "login") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        var_dump($email, $password);

        $usuario = verificar_login($conexion, $email, $password);

        if($usuario) {
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['msg'] = "Email o contraseña incorrectos";
            header('Location: login.php');
        }
    }
     
    if($_POST['accion'] && $_POST['accion'] == "registro") {
        $nombre_usuario = $_POST['nombre_usuario'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(registrar_usuario($conexion, $nombre_usuario, $email, $password)) {
            $_SESSION['msg'] = "Usuario creado con exito";
            
            header('Location: login.php');
            exit();
        } else {
            $_SESSION['msg'] = "Error al crear usuario";
            header('Location: registro.php');
        }
    }
}


?>