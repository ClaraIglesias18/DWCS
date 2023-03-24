<?php
require_once('../model/Usuario.php');
require_once('../model/Evento.php');
require_once('../model/SelectorPersistente.php');

session_start();

if(!isset($_SESSION['correo'])) {
    header("location:login.php");
    exit();
}

$salida = " ";
    
$idUsuario = $_GET['idUsuario'];

$evento = SelectorPersistente::getEventoPersistente($_SESSION['bdd']);
$usuario = SelectorPersistente::getUsuarioPersistente($_SESSION['bdd']);

foreach($evento->getAll($idUsuario) as $evento) {
    $evento->delete($evento->getIdEvento());
}

$usuario->delete($idUsuario);
header("location:admin.php");
exit();