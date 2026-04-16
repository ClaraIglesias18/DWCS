<?php
session_start();
require_once('db.php');
require_once('funciones_marcas.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($_POST['accion'] && $_POST['accion'] == "crear") {
        $nombre = $_POST['nombre'];
        $pais = $_POST['pais'];

        if (insertar_marca($conexion, $nombre, $pais)) {
            $_SESSION['msg'] = "Marca creada exitosamente.";
        } else {
            $_SESSION['msg'] = "Error al crear la marca.";
        }
    }

    if($_POST['accion'] && $_POST['accion'] == "editar") {
        $id_marca = $_POST['id_marca'];
        $nombre = $_POST['nombre'];
        $pais = $_POST['pais'];

        if (editar_marca($conexion, $id_marca, $nombre, $pais)) {
            $_SESSION['msg'] = "Marca editada exitosamente.";
        } else {
            $_SESSION['msg'] = "Error al editar la marca.";
        }
    }
}

if($_GET['id_marca'] && $_GET['accion'] == "eliminar") {
    $id_marca = $_GET['id_marca'];

    if (eliminar_marca($conexion, $id_marca)) {
        $_SESSION['msg'] = "Marca eliminada exitosamente.";
        
    } else {
        $_SESSION['msg'] = "Error al eliminar la marca.";
    }
}

header("Location: index.php");
exit;