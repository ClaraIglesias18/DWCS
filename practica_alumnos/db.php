<?php
// Configuración de la base de datos
$servidor = "localhost";
$usuario  = "root";      // Usuario por defecto en XAMPP
$password = "abc123.";          // Contraseña por defecto en XAMPP (vacía)
$base_datos = "sistemaescolar";

// 1. Crear la conexión
$conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);

// 2. Comprobar si la conexión ha fallado
if (!$conexion) {
    // Si falla, detenemos el script y mostramos el error
    die("❌ Error de conexión: " . mysqli_connect_error());
}

// 3. Configurar el juego de caracteres a UTF-8
// Esto es VITAL para que los nombres con tildes se vean bien
mysqli_set_charset($conexion, "utf8");

// Nota: No cerramos la etiqueta de PHP si el archivo es solo código puro.
// Esto evita que se envíen espacios en blanco accidentales al navegador.