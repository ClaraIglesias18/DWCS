<?php
if(isset($_SESSION['correo'])){
    header('Location: privado.php');
    exit();
} else {
    header('Location: login.php');
    exit();
}
?>