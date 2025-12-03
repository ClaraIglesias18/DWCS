<?php
session_start();
require_once 'funciones.php';

// Llamar a la función para eliminar sesión y cookie 
resetear_sesion_y_cookie();

// Devolver el control a tienda.php 
header('Location: tienda.php');
exit;