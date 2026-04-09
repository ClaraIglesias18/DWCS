<?php
session_start();
require_once('db.php');
require_once('funciones.php');

$id_producto = $_GET['id'];
$id_usuario = $_SESSION['id_usuario'];

$resultado = eliminar_favorito($conexion, $id_producto, $id_usuario);

if($resultado) {
    $_SESSION['mensaje'] = "Producto desmarcado correctamente";
} else {
    $_SESSION['mensaje'] = "Error al desmarcar producto";
}

header('Location: mis_favoritos.php');
exit();