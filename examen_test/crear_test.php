<?php
session_start();
require_once 'db.php';
require_once 'funciones_tests.php';

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$titulo = $_POST['titulo'];
$id_test = crear_test($conexion, $titulo);
if ($id_test !== false) {
    var_dump($id_test);
    
    header("Location: añadir_preguntas.php?id=$id_test");
    exit();
} else {
    $_SESSION['msg'] = "Error al crear el test.";
    header("Location: panel.php");
    exit();
}
