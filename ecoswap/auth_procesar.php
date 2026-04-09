<?php
session_start();
require_once('db.php');
require_once('funciones.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // -----------  LOGIN -----------
    if($_GET['action'] && $_GET['action'] == 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $usuario = verificar_login($conexion, $email, $password);

        if($usuario) {
            $_SESSION['id_usuario'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            
            $_SESSION['mensaje'] = "Sesion iniciada correctamente";
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['mensaje'] = "Email o contraseña incorrectos";
            header('Location: login.php');
            exit();
        }
    }
    
    // ----------- RESGISTRO -----------

    if($_GET['action'] && $_GET['action'] == 'registro') {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $uusario_existente = obtener_usuario_por_email($conexion, $email);

        if($uusario_existente) {
            $_SESSION['mensaje'] = "Email ya en uso";
            header('Location: registro.php');
            exit();
        } else {
            $registro = registrar_usuario($conexion, $nombre, $email, $password);

            if($registro) {
                $_SESSION['mensaje'] = "Usuario registrado correctamente";
                header('Location: login.php');
                exit();
            } else {
                $_SESSION['mensaje'] = "Error al registrar";
                header('Location: registro.php');
                exit();
            }
        }   
    }
}