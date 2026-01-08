<?php
// 1. Necesitamos acceder a la sesión actual para poder destruirla
session_start();

// 2. Limpiamos todas las variables de sesión ($_SESSION['username'], etc.)
session_unset();

// 3. Destruimos la sesión en el servidor
session_destroy();

// 4. Redirigimos al usuario a la página de inicio o login
header("Location: index.php?msg=sesion_cerrada");
exit;
?>