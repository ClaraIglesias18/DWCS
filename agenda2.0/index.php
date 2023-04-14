<?php
session_start();
if (!isset($_SESSION['idUsuario'])) {
    header("location:view/login.php");
    exit();
} else {
    header("location:view/privado.php");
    //header("location:privado.php");
    exit();
}
?>