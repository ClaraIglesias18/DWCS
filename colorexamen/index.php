<?php
// =======================================================
// ARCHIVO: index.php
// MISIÓN: Mostrar formulario, gestionar cookies y cerrar sesión.
// =======================================================

session_start(); // 1. OBLIGATORIO: Inicia la sesión.

// --- LÓGICA DE CERRAR SESIÓN ---
if (isset($_POST['cerrar_sesion'])) {
    session_unset();   // Borra las variables de la sesión.
    session_destroy(); // Destruye la sesión.
}

// --- LÓGICA DE COOKIES (Básica y 1 Hora) ---
$nombre_cookie = "contador_visitas";
$visitas = 1;

if (isset($_POST['borrar_cookie'])) {
    setcookie($nombre_cookie, "", time() - 3600); // Tiempo en el pasado para borrar
    $visitas = 0;
    $mensaje_cookie = "Cookie borrada correctamente.";
} else {
    if (isset($_COOKIE[$nombre_cookie])) {
        $visitas = $_COOKIE[$nombre_cookie] + 1;
    }
    // 🚨 TIEMPO DE COOKIE: time() + 3600 segundos (1 hora)
    setcookie($nombre_cookie, $visitas, time() + 3600); 
    
    if (isset($_POST['guardar_cookie'])) {
        $mensaje_cookie = "Cookie guardada manual.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Examen</title>
    </head>
<body>

    <h3>GESTIÓN DE COOKIES</h3>
    Visitas: <strong><?php echo $visitas; ?></strong><br>
    <?php if(isset($mensaje_cookie)) echo $mensaje_cookie . "<br>"; ?>

    <form action="index.php" method="POST">
        <input type="submit" name="guardar_cookie" value="Guardar Cookie">
        |
        <input type="submit" name="borrar_cookie" value="Borrar Cookie">
    </form>
    
    <hr>

    <h2>Iniciar Sesión</h2>

    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color:red; font-weight:bold;'>Error: ";
        // Mensaje adaptado: Ya no hay error de "código".
        if ($_GET['error'] == 'vacios') echo "Completa el campo de nombre.";
        if ($_GET['error'] == 'nombre') echo "Nombre entre 4 y 6 caracteres.";
        echo "</p>";
    }
    ?>

    <form action="valida.php" method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre"><br><br>

        <label>Color Favorito:</label><br>
        <select name="color">
            <option value="">-- Selecciona un color --</option> 
            <option value="Amarillo">Amarillo</option>
            <option value="Verde">Verde</option>
            <option value="Rojo">Rojo</option>
            <option value="Azul">Azul</option>
        </select>
        <br><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>