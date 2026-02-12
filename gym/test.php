<?php
header('Content-Type: text/html; charset=utf-8');

// 1. Definimos la clave y generamos el hash
$password_original = "c";
$hash_generado = password_hash($password_original, PASSWORD_DEFAULT);

echo "<h2>Prueba de Hash PHP</h2>";
echo "<b>Contraseña original:</b> " . $password_original . "<br>";
echo "<b>Hash generado ahora mismo:</b> " . $hash_generado . "<br>";
echo "<b>Longitud del hash:</b> " . strlen($hash_generado) . " caracteres<br>";

echo "<hr>";

// 2. Simulamos la verificación
if (password_verify("c", $hash_generado)) {
    echo "<span style='color:green; font-weight:bold;'>✅ ÉXITO: La verificación funciona correctamente.</span>";
} else {
    echo "<span style='color:red; font-weight:bold;'>❌ ERROR: La verificación falló.</span>";
}

echo "<hr>";

// 3. Prueba con el hash que me pasaste de tu base de datos
$hash_tu_bdd = '$2y$10$K3ZcM7Bu7mJo3MCn6/f8nO1UWVScCqG6VeYwAVENyS52ftqdZDC5O';
echo "<b>Probando con el hash de tu var_dump...</b><br>";

if (password_verify("c", $hash_tu_bdd)) {
    echo "<span style='color:green;'>✅ El hash de tu BDD sí coincide con 'c'.</span>";
} else {
    echo "<span style='color:red;'>❌ El hash de tu BDD NO coincide con 'c'.</span>";
}
?>