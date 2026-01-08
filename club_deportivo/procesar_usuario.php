<?php
session_start(); // Iniciamos sesión para poder guardar los datos del usuario
require_once 'db.php'; // Archivo donde tienes la conexión $conexion
require_once 'funciones_usuarios.php'; // Las funciones que creamos antes

// Verificamos que los datos vengan por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion'])) {

    $accion = $_POST['accion'];

    // --- LÓGICA DE REGISTRO ---
    if ($accion === 'registrar') {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $nivel = $_POST['nivel'];

        // Intentamos registrar
        $registro_exitoso = registrar_usuario($conexion, $user, $pass, $nivel);

        if ($registro_exitoso) {
            // Si sale bien, al login con un mensaje de éxito
            header("Location: login.php?msg=ok");
            exit;
        } else {
            // Si sale mal (ej: usuario duplicado), volvemos con error
            header("Location: registro.php?msg=duplicado");
            exit;
        }
    }

    // --- LÓGICA DE LOGIN ---
    if ($accion === 'login') {
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        // Verificamos credenciales
        $usuario = verificar_login($conexion, $user, $pass);

        if ($usuario) {
            // ¡Éxito! Guardamos los datos importantes en la SESSION
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['username'] = $usuario['username'];
            $_SESSION['nivel'] = $usuario['nivel'];

            // Enviamos a la cartelera de pistas
            header("Location: index.php");
            exit;
        } else {
            // Error de credenciales
            header("Location: login.php?msg=login_fallido");
            exit;
        }
    }
} else {
    // Si alguien intenta entrar a este archivo sin enviar el formulario, lo echamos
    header("Location: index.php");
    exit;
}