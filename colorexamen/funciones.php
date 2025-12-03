<?php
// =======================================================
// ARCHIVO: funciones.php
// MISIÓN: Contiene las reglas de validación y auxiliares de color.
// =======================================================

// FUNCIÓN 1: Validar que el nombre tenga entre 4 y 6 caracteres (SIN CAMBIOS)
function validarNombre($nombre) {
    $longitud = strlen($nombre);
    if ($longitud >= 4 && $longitud <= 6) {
        return true; 
    }
    return false;
}

// FUNCIÓN 2: Convertir el color del texto a un código CSS compatible
function obtenerColorCSS($colorEspanol) {
    $colorLower = strtolower($colorEspanol); 
    
    // Mapeamos el nombre del color en español al código CSS (ej: 'rojo' -> 'red')
    switch ($colorLower) {
        case 'amarillo':
            return 'yellow';
        case 'verde':
            return 'green';
        case 'rojo':
            return 'red';
        case 'azul':
            return 'blue';
        case 'negro':
        case 'antiguo/negro': // Caso añadido para manejar entradas antiguas en historial.php
        default:
            return 'black';
    }
}
?>