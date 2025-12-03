<?php
session_start();
require_once 'funciones.php';

$errores = [];

// VALIDACION DE NOMBRE, PRODUCTO Y CANTIDAD

if(empty($_POST['nombre']) && !isset($_COOKIE['nombre'])) {
    $errores[] = "El nombre no puede estar vacio la primera vez.";
}

if(empty($_POST['producto'])) {
    $errores[] = "El producto no puede estar vacio.";
}

if(empty($_POST['cantidad']) || $_POST['cantidad'] % 3 != 0) {
    $errores[] = "La cantidad no puede estar vacia y tiene que ser multiplo de 3.";
}

// SI HAY ERRORES, GUARDARLOS EN SESION Y REDIRIGIR A TIENDA.PHP
if(!empty($errores)) {

    $_SESSION['datos_entrada'] = [
        'nombre' => $_POST['nombre'] ?? '',
        'producto' => $_POST['producto'] ?? '',
        'cantidad' => $_POST['cantidad'] ?? '',
    ];

    $_SESSION['errores'] = $errores;
    header('Location: tienda.php');
    exit();
}

// CREAR COOKIE DE NOMBRE SI NO EXISTE
if(!isset($_COOKIE['nombre'])) {
    setcookie('nombre', $_POST['nombre'], time() + 90, "/");
}

$producto = $_POST['producto'];
$cantidad = (int) $_POST['cantidad'];

// AÑADIR PRODUCTO AL CARRITO 
if(isset($_SESSION['carrito'][$producto])) {
    $_SESSION['carrito'][$producto] += $cantidad;
} else {
    $_SESSION['carrito'][$producto] = $cantidad;
}
header('Location: carrito.php');
exit;

?>