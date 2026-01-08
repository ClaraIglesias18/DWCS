<?php
session_start();
require_once 'db.php';
require_once 'funciones_reservas.php';

// 1. Protección: Si no está logueado, no puede reservar
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?error=sesion_requerida");
    exit;
}

// 2. Comprobar que los datos vienen por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Recogemos y limpiamos los datos
    $id_usuario = $_SESSION['usuario_id'];
    $id_pista   = intval($_POST['id_pista']);
    $fecha      = $_POST['fecha'];
    $hora       = $_POST['hora'];

    // 3. VALIDACIÓN DE SEGURIDAD: ¿Sigue la pista libre?
    // (Por si otro usuario ha reservado la misma pista mientras este lo pensaba)
    if (esta_pista_disponible($conexion, $id_pista, $fecha, $hora)) {
        
        // 4. Intentar crear la reserva
        $exito = crear_reserva($conexion, $id_usuario, $id_pista, $fecha, $hora);

        if ($exito) {
            // ¡Todo perfecto! Vamos al perfil para ver la confirmación
            header("Location: perfil.php?msg=exitosa");
            exit;
        } else {
            // Error técnico (BDD)
            header("Location: reserva.php?id_pista=$id_pista&msg=db");
            exit;
        }

    } else {
        // La pista se ha ocupado justo antes de enviar el formulario
        header("Location: reserva.php?id_pista=$id_pista&fecha=$fecha&msg=ocupada");
        exit;
    }

} else {
    // Si intentan entrar directamente al archivo, los mandamos al inicio
    header("Location: index.php");
    exit;
}