<?php
session_start();
require_once 'funciones.php';

resetear_sesion();

// Devolver el control a tienda.php 
header('Location: tienda.php');
exit;