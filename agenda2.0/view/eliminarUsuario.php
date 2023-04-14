<?php
require_once('../model/Usuario.php');
require_once('../model/Evento.php');
require_once('../model/SelectorPersistente.php');

session_start();

if(!isset($_SESSION['idUsuario'])) {
    header("location:login.php");
    exit();
}
    
$idUsuario = $_GET['idUsuario'];

$evento = SelectorPersistente::getEventoPersistente($_SESSION['bdd']);
$usuario = SelectorPersistente::getUsuarioPersistente($_SESSION['bdd']);

foreach($evento::getAll($idUsuario) as $event) {
    $event->delete($event->getIdEvento());
}

$usuario->delete($idUsuario);

header("location:admin.php");
exit();