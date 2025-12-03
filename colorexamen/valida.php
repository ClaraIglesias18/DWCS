<?php
// =======================================================
// ARCHIVO: valida.php
// MISIÓN: Recibir datos, juzgarlos, y asignar color por defecto.
// =======================================================

session_start(); 
include 'funciones.php'; 

// 1. RECOGER DATOS
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
$color = isset($_POST['color']) ? $_POST['color'] : ""; // Recibimos el color

// 2. VALIDACIÓN DE VACÍOS (Solo el nombre no puede ir vacío)
if (empty($nombre)) {
    header("Location: index.php?error=vacios");
    exit(); 
}

// 3. VALIDACIÓN DE NOMBRE
if (!validarNombre($nombre)) {
    header("Location: index.php?error=nombre");
    exit();
}

// 4. NUEVA REGLA LÓGICA: ASIGNAR 'Negro' SI NO SE SELECCIONÓ NADA
// El campo 'color' puede venir vacío del <option value="">
if (empty($color)) {
    $color = 'Negro'; // Asignamos el valor por defecto
}

// --- ZONA SEGURA ---

// 5. GUARDAR DATOS EN SESIÓN (Nuevas claves)
$_SESSION['usuario_actual'] = $nombre;
$_SESSION['color_actual'] = $color; 

// 6. GESTIÓN DEL HISTORIAL
if (!isset($_SESSION['historial'])) {
    $_SESSION['historial'] = array();
}

// Creamos el registro con la nueva clave 'color_favorito'
$nuevo_registro = array(
    'nombre' => $nombre,
    'color_favorito' => $color 
);

$_SESSION['historial'][] = $nuevo_registro;

// 7. Redirección
header("Location: bienvenida.php");
exit();
?>