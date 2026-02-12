<?php
require_once('db.php');
require_once('funciones_reservas.php');

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$id_clase = $_GET['id'];
$id_usuario = $_SESSION['id_usuario'];

cancelar_reserva($conexion, $id_clase, $id_usuario);
mysqli_close($conexion);
header("Location: panel.php");
exit;
