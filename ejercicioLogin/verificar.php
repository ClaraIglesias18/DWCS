<?php
session_start();

// Datos Fijos para el ejemplo
const USER_CORRECTO = 'admin';
const PASS_CORRECTA = '1234';
const EXPIRACION_COOKIE = 60 * 60 * 24 * 7; // 7 días

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';
    $recordarme = isset($_POST['recordarme']);

    // 1. Verificar Credenciales
    if ($usuario === USER_CORRECTO && $password === PASS_CORRECTA) {
        
        // A. Autenticación Exitosa
        $_SESSION['autenticado'] = true;
        $_SESSION['usuario'] = $usuario; // Guardar el usuario en sesión
        
        // 2. Lógica "Recordarme" (Cookie)
        if ($recordarme) {
            // Establecer la cookie de recordatorio con el nombre de usuario por 7 días
            setcookie('recuerdame', $usuario, time() + EXPIRACION_COOKIE, "/");
        } else {
            // Si el usuario no marcó "recordarme" y la cookie existe, la borramos
            if (isset($_COOKIE['recuerdame'])) {
                setcookie('recuerdame', '', time() - 3600, "/");
            }
        }
        
        // Redirigir al panel privado (PRG)
        header('Location: privado.php');
        exit();

    } else {
        // B. Fallo de Autenticación
        $_SESSION['error_login'] = "Usuario o contraseña incorrectos.";
        
        // Redirigir de vuelta al login
        header('Location: login.php');
        exit();
    }
} else {
    // Si se accede directamente sin POST, redirigir al login
    header('Location: login.php');
    exit();
}