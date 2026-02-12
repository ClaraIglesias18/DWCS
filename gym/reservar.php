<?php
session_start();
require_once 'db.php';
require_once 'funciones_reservas.php';
require_once 'funciones_clases.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$id_clase = $_GET['id'];
$id_usuario = $_SESSION['id_usuario'];


if (contar_reservas($conexion, $id_clase) >= obtener_cupo($conexion, $id_clase)) {
    $_SESSION['msg'] = "Lo sentimos, esta clase ya está llena.";
} else if (obtener_reserva_id($conexion, $id_clase, $id_usuario)) {
    $_SESSION['msg'] = "Ya tienes una reserva para esta clase.";
} else {
    $resultado = reservar($conexion, $id_clase, $id_usuario);
    mysqli_close($conexion);

    if ($resultado) {
        $_SESSION['msg'] = "Reserva realizada con éxito.";
    } else {
        $_SESSION['msg'] = "Error al realizar la reserva.";
    }
}

header("Location: panel.php");
exit;
