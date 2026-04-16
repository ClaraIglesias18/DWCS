<?php
session_start();
require_once('db.php');
require_once('funciones_modelos.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if($_POST['accion'] && $_POST['accion'] == "crear") {
        $nombre = $_POST['nombre'];
        $anio = $_POST['anio'];
        $id_marca = $_POST['id_marca'];

        if (insertar_modelo($conexion, $nombre, $anio, $id_marca)) {
            $_SESSION['msg'] = "Modelo creado exitosamente.";
        } else {
            $_SESSION['msg'] = "Error al crear el modelo.";
        }
    }

    if($_POST['accion'] && $_POST['accion'] == "editar") {
        $id_modelo = $_POST['id_modelo'];
        $nombre = $_POST['nombre'];
        $anio = $_POST['anio'];
        $id_marca = $_POST['id_marca'];

        if (editar_modelo($conexion, $id_modelo, $nombre, $anio, $id_marca)) {
            $_SESSION['msg'] = "Modelo editado exitosamente.";
        } else {
            $_SESSION['msg'] = "Error al editar el modelo.";
        }
    }   
}

if($_GET['id_modelo'] && $_GET['accion'] == "eliminar") {
    $id_modelo = $_GET['id_modelo'];

    if (eliminar_modelo($conexion, $id_modelo)) {
        $_SESSION['msg'] = "Modelo eliminado exitosamente.";
    } else {
        $_SESSION['msg'] = "Error al eliminar el modelo.";
    }
}

header("Location: index.php");
exit;