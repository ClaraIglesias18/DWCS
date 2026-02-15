<?php
session_start();
require_once 'db.php';
require_once 'funciones_clases.php';

if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['actividad'];
    $descripcion = $_POST['dia_semana'];
    $horario = $_POST['hora'];
    $cupos = $_POST['cupo_maximo'];

    if (crear_clase($conexion, $nombre, $descripcion, $horario, $cupos)) {
        $_SESSION['msg'] = "Clase creada exitosamente.";
    } else {
        $_SESSION['msg'] = "Error al crear la clase.";
    }
    mysqli_close($conexion);
    header("Location: panel.php");
    exit();
}