<?php
session_start();
require_once 'db.php';
require_once 'funciones_reservas.php';

// 1. Verificación de seguridad: ¿Está logueado?
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

// 2. Verificación de datos: ¿Viene el ID de la reserva por la URL?
if (isset($_GET['id'])) {
    $id_reserva = intval($_GET['id']);
    $id_usuario = $_SESSION['usuario_id'];

    // 3. Llamamos a la función de borrado
    // Le pasamos el ID de la reserva Y el ID del usuario para que solo borre las SUYAS
    $borrado_exitoso = cancelar_reserva($conexion, $id_reserva, $id_usuario);

    if ($borrado_exitoso) {
        // Redirigimos al perfil con un mensaje de éxito
        header("Location: perfil.php?msg=");
        exit;
    } else {
        // Redirigimos con mensaje de error
        header("Location: perfil.php?msg=error_borrado");
        exit;
    }
} else {
    // Si no hay ID, mandamos al perfil directamente
    header("Location: perfil.php");
    exit;
}