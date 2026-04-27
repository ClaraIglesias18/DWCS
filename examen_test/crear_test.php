<?php
session_start();
require_once 'db.php';
require_once 'funciones_tests.php';

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$titulo = $_POST['titulo'];
if (crear_test($conexion, $titulo)) {
    $_SESSION['msg'] = "Test creado con exito";
} else {
    $_SESSION['msg'] = "Error al crear el test.";
}

header("Location: panel.php");
exit();
