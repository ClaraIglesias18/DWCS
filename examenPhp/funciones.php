<?php
function invertir_nombre($nombre) {
    return strrev($nombre); 
}

function validar_vacio($valor) {
    return empty($valor); 
}

function validar_multiplo_tres($cantidad) {
    return is_numeric($cantidad) && $cantidad > 0 && ($cantidad % 3) === 0; 
}


function calcular_precio_total($carrito, $precios) {
    $total = 0;
    
    foreach ($carrito as $producto_clave => $cantidad) {
        
        $precio_unitario = $precios[$producto_clave] ?? 0;
        
        $total += $cantidad * $precio_unitario; 
    }
    return $total;
}

function resetear_sesion() {
    session_unset();
    session_destroy();
}

/**<?php
$cadena_original = "Ejemplo";
$cadena_invertida = "";

// Obtener la longitud de la cadena
$longitud = strlen($cadena_original);

// Recorrer la cadena desde el último carácter hasta el primero (índice 0)
for ($i = $longitud - 1; $i >= 0; $i--) {
    // Concatenar cada carácter en orden inverso
    $cadena_invertida .= $cadena_original[$i];
}

echo "Original: " . $cadena_original . "\n";
echo "Invertida: " . $cadena_invertida . "\n"; 
// Salida: Invertida: olpmejE
?>*/