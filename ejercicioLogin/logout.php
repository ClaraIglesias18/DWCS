<?php
session_start();

// 1. Destruir la sesión (eliminar $_SESSION)
session_unset(); // Elimina todas las variables de la sesión
session_destroy(); // Destruye el archivo de sesión en el servidor


// 3. Redirigir al inicio
header('Location: login.php');
exit();