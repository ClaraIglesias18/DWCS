<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location:login.php");
    exit();
} else {
    header("location:privado.php");
    //header("location:privado.php");
    exit();
}
?>