<?php
/**
 * Invertir el nombre del cliente.
 * @param string $nombre
 * @return string Nombre invertido
 */
function invertir_nombre($nombre) {
    // La función strrev() de PHP invierte una cadena
    return strrev($nombre); // [cite: 49]
}

/**
 * Valida que un campo no esté vacío.
 * @param mixed $valor
 * @return bool True si es válido (no vacío), False en caso contrario
 */
function validar_no_vacio($valor) {
    return !empty($valor); // [cite: 48]
}

/**
 * Valida que la cantidad sea un múltiplo de 3.
 * @param int $cantidad
 * @return bool True si es múltiplo de 3, False en caso contrario
 */
function validar_multiplo_tres($cantidad) {
    // La cantidad debe ser un número entero y el resto de la división por 3 debe ser 0
    return is_numeric($cantidad) && $cantidad > 0 && ($cantidad % 3) === 0; // [cite: 30, 48]
}

/**
 * Calcula el precio total del carrito de forma dinámica.
 * @param array $cantidades Array asociativo con las cantidades de productos, e.g., ['Libro 1' => 6, ...]
 * @param array $precios Array asociativo con los precios, e.g., ['Libro 1' => 10.00, ...]
 * @return float El precio total
 */
function calcular_precio_total($cantidades, $precios) {
    $total = 0;
    // Iteramos sobre las cantidades. La clave es el nombre del producto (e.g., 'Libro 1')
    foreach ($cantidades as $producto_clave => $cantidad) {
        // Obtenemos el precio unitario del array de precios
        $precio_unitario = $precios[$producto_clave] ?? 0;
        // Sumamos el subtotal (cantidad * precio unitario) al total
        $total += $cantidad * $precio_unitario; // [cite: 50, 51]
    }
    return $total;
}

/**
 * Resetea la sesión y la cookie de nombre.
 */
function resetear_sesion_y_cookie() {
    // Destruye todas las variables de sesión
    session_unset();
    session_destroy();

    // Elimina la cookie del nombre. Se establece con una fecha de caducidad en el pasado.
    if (isset($_COOKIE['nombre_cliente'])) {
        // Tiempo actual - 3600 segundos (una hora en el pasado)
        setcookie('nombre_cliente', '', time() - 3600, "/");
    }
     // [cite: 46, 53]
}