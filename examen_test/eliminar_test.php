<?php
session_start();
require_once 'db.php';
require_once 'funciones_tests.php';

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$id_test = $_GET['id'];

if (eliminar_test($conexion, $id_test)) {
    $_SESSION['msg'] = "Test eliminado exitosamente.";
} else {
    $_SESSION['msg'] = "Error al eliminar el test.";
}

header("Location: panel.php");
exit();
