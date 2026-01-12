<?php
session_start();

// 1. Limpiamos todas las variables de sesión
session_unset();
// 3. Destruimos la sesión en el servidor
session_destroy();

// 4. Redirigimos al login con un mensaje de confirmación
header("Location: login.php");
exit;
?>