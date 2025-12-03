<?php
function invertir_nombre($nombre) {
    $partes = explode(' ', $nombre);
    return implode(' ', array_reverse($partes));
}

function calcular_precio_total($carrito, $precios) {
    $total = 0;
    foreach ($carrito as $producto => $cantidad) {
        $precio_unitario = $precios[$producto] ?? 0;
        $total += $cantidad * $precio_unitario;
    }
    return $total;
}

function calcular_precio_por_producto($cantidad, $precio_unitario) {
    return $cantidad * $precio_unitario;
}

function resetear_sesion() {
    session_unset();
    session_destroy();
}
?>