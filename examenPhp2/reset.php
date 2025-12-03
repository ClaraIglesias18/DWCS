<?php
session_start();
include_once 'funciones.php';
resetear_sesion();
header('Location: tienda.php');
exit;
?>