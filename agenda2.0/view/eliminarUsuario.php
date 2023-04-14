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

//falta la eliminacion de eventos del usuario antes de eliminarlo
//se necesita primero biscar si hay eventos con el id usuario y despues si es afirmativos se borran para no pasar null
/*foreach($evento->getAll($idUsuario) as $evento) {
    $evento->delete($evento->getIdEvento());
}*/

$usuario->delete($idUsuario);

header("location:admin.php");
exit();