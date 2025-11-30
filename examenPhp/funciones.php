<?php
/**function reset() {
    session_start();
    session_unset();      // Borra todas las variables de sesión
    session_destroy();    // Destruye la sesión
    setcookie("PHPSESSID", "", time() - 3600); // Borra cookie de sesión
    setcookie("nombre", "", time() - 3600);    // Borra cookie del nombre
    header("Location: tienda.php");
    exit();
}**/

function invertirNombre($nombre) {
    return strrev($nombre);
}

function validarNombre($nombre) {
    if (empty($nombre)) {
        return "El nombre es obligatorio.";
    }
    
    return "";
}

function totalGeneral($carrito, $precios) {
    $total = 0;
    foreach ($carrito as $item) {
        $total += $precios[$item['producto']] * $item['cantidad'];
    }
    return $total;
}

//VALIDACIONES
function validarProducto($producto) {
    if (empty($producto)) {
        return "El producto es obligatorio.";
    }

    return "";
}

function validarCantidad($cantidad) {
    if (empty($cantidad)) {
        return "La cantidad es obligatoria.";
    }

    if($cantidad % 3 != 0){
        return "La cantidad debe ser múltiplo de 3.";
    }

    return "";
}