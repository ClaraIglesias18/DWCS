<?php
session_start();
require_once('db.php');
require_once('funciones.php');

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensaje'] = "Para marcar como favorito debes iniciar sesion";
    header('Location: index.php');
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$id_producto = $_GET['id'];

if (comprobar_favorito($conexion, $id_producto, $id_usuario)) {
    $_SESSION['mensaje'] = "Producto ya esta marcado como favorito";
} else {
    $resultado = insertar_favorito($conexion, $id_producto, $id_usuario);

    if ($resultado) {
        $_SESSION['mensaje'] = "Producto marcado como favorito";
    } else {
        $_SESSION['mensaje'] = "Error al marcar como favorito";
    }
}

header('Location: index.php');
exit();
