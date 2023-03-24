<?php
require_once('../model/Evento.php');
require_once('../model/SelectorPersistente.php');

session_start();

if(!isset($_SESSION['correo'])) {
    header("location:login.php");
    exit();
}

$salida = " ";

if($_SERVER['REQUEST_METHOD'] == "GET") {
    
    $idEvento = $_GET['idEvento'];

    $evento = SelectorPersistente::getEventoPersistente($_SESSION['bdd']);
    
    $evento->delete($idEvento);
    header("location:privado.php");
    exit();

}
