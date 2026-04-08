<?php
session_start();
require_once "db.php";
require_once "funciones.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    //CREACION DE LIBROS

    if($_POST['accion'] == "crear") {
        $titulo = $_POST['titulo'];
        $anio_publicacion = $_POST['anio_publicacion'];
        $autor_id = $_POST['autor_id'];

        if (insertar_libro($conexion, $titulo, $anio_publicacion, $autor_id)) {
            $_SESSION['mensaje'] = "Libro creado exitosamente.";
            header("Location: index.php");
            exit;
        } else {
            $_SESSION['mensaje'] = "Error al crear el libro.";
            header("Location: index.php");
            exit;
        }
    }

    //EDICION DE LIBROS

    if($_POST['accion'] == "editar") {
        $id = $_POST['libro_id'];
        $titulo = $_POST['titulo'];
        $anio_publicacion = $_POST['anio_publicacion'];
        $autor_id = $_POST['autor_id'];

        if (editar_libro($conexion, $id, $titulo, $anio_publicacion, $autor_id)) {
            $_SESSION['mensaje'] = "Libro editado exitosamente.";
            header("Location: index.php");
            exit;
        } else {
            $_SESSION['mensaje'] = "Error al editar el libro.";
            header("Location: index.php");
            exit;
        }
    }
}

// ELIMINACION DE LIBROS
if($_GET['libro_id'] && $_GET['accion'] == "eliminar") {
    $libro_id = $_GET['libro_id'];

    if (eliminar_libro($conexion, $libro_id)) {
        $_SESSION['mensaje'] = "Libro eliminado exitosamente.";
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['mensaje'] = "Error al eliminar el libro.";
        header("Location: index.php");
        exit;
    }
}