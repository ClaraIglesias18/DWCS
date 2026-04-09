<?php
session_start();
require_once('db.php');
require_once('funciones.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['accion'] && $_POST['accion'] == 'crear') {
        $usuario_id = $_POST['usuario_id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['price'];
        $categoria = $_POST['cat'];
        $img = $_FILES['foto']['name'];
        $estado = "Disponible";

        $directorio = "img/";

        $ruta = $directorio . $img;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta)) {
            insertar_productos($conexion, $usuario_id, $nombre, $descripcion, $precio, $img,  $categoria, $estado);
            $_SESSION['mensaje'] = "Artículo subido correctamente";
        } else {
            $_SESSION['mensaje'] = "Error al subir el artículo";
        }

        header('Location: index.php');
        exit();
    }

    if($_POST['accion'] && $_POST['accion'] == 'editar') {
        $id_producto = $_POST['id_producto'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['price'];
        $categoria = $_POST['cat'];
        $estado = "Disponible";

        if($_FILES['foto']['name']) {
            $img = $_FILES['foto']['name'];
            $directorio = "img/";
            $ruta = $directorio . $img;

            move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
        } else {
            // Si no se sube una nueva imagen, mantenemos la existente
            $producto_actual = obtener_producto_por_id($conexion, $id_producto);
            $img = $producto_actual['imagen'];
        }

        if (editar_producto($conexion, $id_producto, $nombre, $descripcion, $precio, $img, $categoria, $estado)) {
            
            $_SESSION['mensaje'] = "Artículo editado correctamente";
        } else {
            $_SESSION['mensaje'] = "Error al editar el artículo";
        }

        header('Location: mis_articulos.php');
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_producto = $_GET['id'];
    eliminar_producto($conexion, $id_producto);
    $_SESSION['mensaje'] = "Artículo eliminado correctamente";
    header('Location: mis_articulos.php');
    exit();
}
