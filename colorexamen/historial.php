<?php
// =======================================================
// ARCHIVO: historial.php
// MISIÓN: Mostrar el array de logins con el color y borrar el historial.
// =======================================================

session_start(); 
include 'funciones.php'; 

// --- NUEVA LÓGICA DE BORRADO DE HISTORIAL (SESIONES) ---
$mensaje_historial = '';
// Pregunta: ¿Se ha pulsado el botón 'borrar_historial'?
if (isset($_POST['borrar_historial'])) {
    // Comprobamos que el array existe antes de intentar eliminarlo
    if (isset($_SESSION['historial'])) {
        // La función unset() elimina una variable de PHP, en este caso, el historial.
        unset($_SESSION['historial']);
        $mensaje_historial = '🗑️ ¡Historial de sesiones borrado con éxito!';
    } else {
        $mensaje_historial = 'El historial ya estaba vacío.';
    }
}
// ------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Sesiones</title>
    <style>
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 8px; }
    </style>
</head>
<body>
    <h2>Usuarios que han iniciado sesión</h2>

    <?php if ($mensaje_historial): ?>
        <p style='color:orange; font-weight:bold;'><?php echo $mensaje_historial; ?></p>
    <?php endif; ?>

    <form action="historial.php" method="POST" style="margin-bottom: 20px;">
        <input type="submit" name="borrar_historial" value="Borrar Historial de Logins (Sesiones)" style="color: orange;">
    </form>

    <?php
    // Usamos el mismo chequeo, que ahora puede dar false si acabamos de borrarlo.
    if (isset($_SESSION['historial'])) {
        echo "<table>";
        echo "<tr><th>Nombre Usuario</th><th>Color Favorito</th><th>Detalle</th></tr>";

        foreach ($_SESSION['historial'] as $fila) {
            
            // Corrección del Error: Programación defensiva
            $colorEspanol = isset($fila['color_favorito']) ? $fila['color_favorito'] : 'Antiguo/Negro';
            
            $colorCSS = obtenerColorCSS($colorEspanol);
            
            $textoDetalle = ($colorEspanol == 'Negro' || $colorEspanol == 'Antiguo/Negro') ? 
                'No tiene color favorito' : 
                'Su color favorito es ' . $colorEspanol;

            echo "<tr>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td style='color: " . $colorCSS . ";'><strong>" . $colorEspanol . "</strong></td>";
            echo "<td style='color: " . $colorCSS . ";'>" . $textoDetalle . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "El historial de inicios de sesión está vacío.";
    }
    ?>
    
    <br><br>
    <a href="bienvenida.php">Volver</a> | <a href="index.php">Nuevo Login</a>
</body>
</html>