<?php
include_once('Evento.php');
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if(!isset($_SESSION['usuario'])) {
    header("location:login.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$eventos = unserialize($_SESSION['eventos']);
$salida = " ";


if($_SERVER['REQUEST_METHOD'] == "GET") {
    
    $id = $_GET['id'];


    foreach($eventos as $evento) {
        if($evento->getIdEvento() == $id) {
            unset($eventos[array_search($evento, $eventos)]);
            $eventos = array_values($eventos);
            $_SESSION['eventos'] = serialize($eventos);
            header("location:privado.php");
            exit();
        }
    }
}

?>