<?php
session_start();
require_once "db.php";
require_once "funciones.php";


//INSERCION Y EDICION DE AUTORES

if($_SERVER["REQUEST_METHOD"] == "POST") {

    //CREACION DE AUTORES

    if($_POST['accion'] == "crear") {
        $nombre = $_POST['nombre'];
        $nacionalidad = $_POST['nacionalidad'];

        if (insertar_autor($conexion, $nombre, $nacionalidad)) {
            $_SESSION['mensaje'] = "Autor creado exitosamente.";
            //header("Location: index.php");
            //exit;
        } else {
            $_SESSION['mensaje'] = "Error al crear el autor.";
            header("Location: index.php");
            exit;
        }
    }

    //EDICION DE AUTORES

    if($_POST['accion'] == "editar") {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $nacionalidad = $_POST['nacionalidad'];

        if (editar_autor($conexion, $id, $nombre, $nacionalidad)) {
            $_SESSION['mensaje'] = "Autor editado exitosamente.";
            header("Location: index.php");
            exit;
        } else {
            $_SESSION['mensaje'] = "Error al editar el autor.";
            header("Location: index.php");
            exit;
        }
    }
}

//ELIMINACION DE AUTORES

if($_GET['autor_id'] && $_GET['accion'] == "eliminar") {
    $autor_id = $_GET['autor_id'];

    if (eliminar_autor($conexion, $autor_id)) {
        $_SESSION['mensaje'] = "Autor eliminado exitosamente.";
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['mensaje'] = "Error al eliminar el autor.";
        header("Location: index.php");
        exit;
    }
}