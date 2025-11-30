<?php
session_start();
session_unset();      // Borra todas las variables de sesión
session_destroy();    // Destruye la sesión
setcookie("PHPSESSID", "", time() - 3600); // Borra cookie de sesión
setcookie("nombre", "", time() - 3600);    // Borra cookie del nombre
header("Location: tienda.php");
exit();
?>