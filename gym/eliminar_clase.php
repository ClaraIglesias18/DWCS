<?php
session_start();
require_once 'db.php';
require_once 'funciones_clases.php';

if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$id_clase = $_GET['id'];

if (eliminar_clase($conexion, $id_clase)) {
    $_SESSION['msg'] = "Clase eliminada exitosamente.";
} else {
    $_SESSION['msg'] = "Error al eliminar la clase.";
}

header("Location: panel.php");
exit();
