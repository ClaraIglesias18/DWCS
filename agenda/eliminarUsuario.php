<?php
require_once('Usuario.php');
require_once('SelectorPersistente.php');

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if(!isset($_SESSION['usuario'])) {
    header("location:login.php");
    exit();
}

/*$usuario = $_SESSION['usuario'];
$eventos = unserialize($_SESSION['eventos']);*/
$salida = " ";
    
$idUsuario = $_GET['idUsuario'];

$usuario = SelectorPersistente::getUsuarioPersistente($_SESSION['bdd']);
    
$usuario->eliminar($idUsuario);
header("location:admin.php");
exit();



