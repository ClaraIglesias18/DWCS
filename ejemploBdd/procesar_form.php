<?php
require_once 'funciones.php';

// -------- MANEJO DE PETICIONES POST --------
// PROCESAMOS EL FORMULARIO PARA AÑADIR O ACTUALIZAR UN PRODUCTO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Comprobamos si nos llega una peticion POST con el campo de id_edicion(que viene de la pagina de editar.php)
    if (isset($_POST['id_edicion'])) {
        // Recogemos los datos del formulario en variables
        $id = (int)$_POST['id_edicion'];
        $nombre = trim($_POST['nombre']);
        $precio = (float)$_POST['precio'];

        // Intentar actualizar si hay datos
        if ($id > 0 && !empty($nombre) && $precio > 0) {
            $conexion = conectar_db();
            if ($conexion) {
                // Llamamos a la funcion de actualizar
                if (actualizar_producto($conexion, $id, $nombre, $precio)) {
                    $mensaje = "¡Producto **$nombre** (ID: $id) actualizado con éxito!";
                } else {
                    $mensaje = "ERROR: No se pudo actualizar el producto.";
                }
                cerrar_db($conexion);
            }
        } else {
            $mensaje = "ERROR: Datos inválidos para actualizar.";
        }

        // Redirigir de vuelta a index.php pasandole por GET el mensaje correspondiente
        header("Location: index.php?mensaje=" . urlencode($mensaje));
        exit();
    }

    // Al no haber entrado en el anterior if, comprobamos si nos llegan peticiones POST para insertar por parte de index.php
    if (isset($_POST['nombre']) && isset($_POST['precio'])) {
        // Recogemos los datos del formulario en variables
        $nombre = trim($_POST['nombre']);
        $precio = (float)$_POST['precio'];

        // Intentar insertar si hay datos
        if (!empty($nombre) && $precio > 0) {
            $conexion = conectar_db();

            if ($conexion) {
                // Llamamos a la funcion de insertar
                if (insertar_producto($conexion, $nombre, $precio)) {
                    $mensaje = "¡Producto **$nombre** añadido con éxito!";
                } else {
                    $mensaje = "ERROR: No se pudo añadir el producto.";
                }
                cerrar_db($conexion); // Cerramos la conexión después de usarla
            }
        } else {
            $mensaje = "ERROR: El nombre y el precio deben ser válidos.";
        }

        // Redirigir de vuelta a index.php pasandole por GET el mensaje correspondiente
        header("Location: index.php?mensaje=" . urlencode($mensaje));
        exit();
    }
}

// -------- MANEJO DE PETICIONES GET --------
// PROCESAMOS LAS PETICIONES GET PARA BORRAR UN PRODUCTO

if (isset($_GET['accion']) && $_GET['accion'] === 'borrar' && isset($_GET['id'])) {
    // Recogemos el ID del producto a borrar
    $id_a_borrar = (int)$_GET['id'];

    // Intentar borrar si el ID es válido
    if ($id_a_borrar > 0) {
        $conexion = conectar_db();
        if ($conexion) {
            // Llamamos a la funcion de borrar
            if (borrar_producto($conexion, $id_a_borrar)) {
                $mensaje = "¡Producto con ID **$id_a_borrar** eliminado con éxito! (Vía GET)";
            } else {
                $mensaje = "ERROR: No se pudo eliminar el producto o no se encontró.";
            }
            cerrar_db($conexion);

            // Redirigir de vuelta a index.php para que se actualice la pagina pasandole por GET el mensaje correspondiente
            header("Location: index.php?mensaje=" . urlencode($mensaje));
            exit();
        
        }
    } else {
        $mensaje = "ERROR: ID de producto inválido para borrar.";
    }
}

?>