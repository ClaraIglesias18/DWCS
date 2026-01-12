<?php
session_start();
require_once 'db.php';
require_once 'funciones_alumnos.php';

//  ----------------  PETICIONES POST ----------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($_POST['accion'] == 'añadir') {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $curso = $_POST['curso'];

        if (insertar_alumno($conexion, $nombre, $apellidos, $correo, $curso)) {
            $_SESSION['msg'] = "Alumno añadido correctamente.";
        } else {
            $_SESSION['msg'] = "Error al añadir alumno.";
        }

        mysqli_close($conexion);
        header('Location: index.php');
        exit;
    }

    if($_POST['accion'] == 'editar') {
        $id_alumno = $_POST['id_alumno'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $curso = $_POST['curso'];

        if (actualizar_alumno($conexion, $id_alumno, $nombre, $apellidos, $correo, $curso)) {
            $_SESSION['msg'] = "Alumno actualizado correctamente.";
        } else {
            $_SESSION['msg'] = "Error al actualizar alumno.";
        }
        mysqli_close($conexion);
        header('Location: index.php');
        exit;
    }
}

//  ----------------  PETICIONES GET ----------------
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id_alumno = $_GET['id'];

        if (eliminar_alumno($conexion, $id_alumno)) {
            $_SESSION['msg'] = "Alumno eliminado correctamente.";
        } else {
            $_SESSION['msg'] = "Error al eliminar alumno.";
        }
        mysqli_close($conexion);
        header('Location: index.php');
        exit;
    }
}