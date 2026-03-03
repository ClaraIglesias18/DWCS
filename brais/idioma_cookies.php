<?php
session_start();

// Comprobar si se ha enviado un idioma nuevo por la URL
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lang'])) {
    $idioma = $_POST['lang'];
    // Guardamos la cookie por 30 días
    setcookie('idioma_preferido', $idioma, time() + (86400 * 30), "/");
} else {
    // Si no hay selección nueva, buscamos si ya existe la cookie
    if(isset($_COOKIE['idioma_preferido'])) {
        $idioma = $_COOKIE['idioma_preferido'];
    } else {
        $idioma = 'es'; // Idioma por defecto
    }
}

if($idioma === 'en') {
    $saludo = "Hello! Welcome to our website.";
} else {
    $saludo = "¡Hola! Bienvenido a nuestro sitio web.";
}

?>
<!DOCTYPE html>
<html>
<body>
    <h1><?php echo $saludo; ?></h1>
    <p>Selecciona tu idioma / Select your language:</p>
    <form method="post" action="idioma_cookies.php">
        <button name="lang" value="es">Español</button>
        <button name="lang" value="en">English</button>
    </form>
</body>
</html>