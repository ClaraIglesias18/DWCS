<?php
require_once('Evento.php');
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


if($_SERVER['REQUEST_METHOD'] == "GET") {
    
    $idEvento = $_GET['idEvento'];

    $evento = SelectorPersistente::getEventoPersistente($_SESSION['bdd']);
    
    $evento->eliminar($idEvento);
    header("location:privado.php");
    exit();

}

?>