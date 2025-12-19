<?php
require_once 'funciones.php';
// 2. Lógica para añadir un nuevo producto 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_edicion'])) {
        $id = (int)$_POST['id_edicion'];
        $nombre = trim($_POST['nombre']);
        $precio = (float)$_POST['precio'];

        if ($id > 0 && !empty($nombre) && $precio > 0) {
            $conexion = conectar_db();
            if ($conexion) {
                // LLAMADA A LA FUNCIÓN DE ACTUALIZACIÓN
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

        header("Location: index.php?mensaje=" . urlencode($mensaje) . "&id=" . $modo_edicion);
        exit();
    }
    // Verificar que los datos necesarios existen
    if (isset($_POST['nombre']) && isset($_POST['precio'])) {
        $nombre = trim($_POST['nombre']);
        $precio = (float)$_POST['precio'];

        // Solo intentar insertar si hay datos
        if (!empty($nombre) && $precio > 0) {
            $conexion = conectar_db();

            if ($conexion) {
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

        header("Location: index.php?mensaje=" . urlencode($mensaje));
        exit();
    }
}

// --- 1. Manejo de Petición GET para BORRADO (unsafe method) ---
// Comprobamos si recibimos 'accion=borrar' y el 'id' por la URL ($_GET)
if (isset($_GET['accion']) && $_GET['accion'] === 'borrar' && isset($_GET['id'])) {
    $id_a_borrar = (int)$_GET['id'];

    if ($id_a_borrar > 0) {
        $conexion = conectar_db();
        if ($conexion) {
            if (borrar_producto($conexion, $id_a_borrar)) {
                $mensaje = "¡Producto con ID **$id_a_borrar** eliminado con éxito! (Vía GET)";
            } else {
                $mensaje = "ERROR: No se pudo eliminar el producto o no se encontró.";
            }
            cerrar_db($conexion);

            // REDIRECCIÓN IMPORTANTE: Evita que el usuario borre accidentalmente 
            // al recargar la página (PRG Pattern).
            header("Location: index.php?mensaje=" . urlencode($mensaje));
            exit();
        
        }
    } else {
        $mensaje = "ERROR: ID de producto inválido para borrar.";
    }
}

// --- Manejo de Petición GET para EDITAR ---
/**if (isset($_GET['accion']) && $_GET['accion'] === 'editar' && isset($_GET['id'])) {
    $id_edicion = (int)$_GET['id'];

    if ($id_edicion > 0) {
        $conexion = conectar_db();
        $producto_a_editar = obtener_producto_por_id($conexion, $id_edicion);
        cerrar_db($conexion);

        if ($producto_a_editar) {
            $modo_edicion = true; // Activamos el modo edición
            $mensaje = "Editando producto: **" . htmlspecialchars($producto_a_editar['nombre']) . "**";
            header("Location: index.php?mensaje=" . urlencode($mensaje) . "&modo_edicion=" . $modo_edicion);
            exit();
        } else {
            $mensaje = "ERROR: Producto a editar no encontrado.";
        }
    }
}**/

?>