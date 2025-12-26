<?php
session_start();
require_once('funciones.php');

$mensaje = '';

// ------- METODO POST -------

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Conexion a base de datos

    $conexion = conectar_db();
    if (!$conexion) {
        $mensaje = "ERROR: No se pudo conectar a la base de datos.";
        $_SESSION['mensaje'] = $mensaje;
        header('Location: login.php');
        exit();
    }

    // Insercion de tareas

    if (isset($_POST['accion']) && $_POST['accion'] == 'crear') {
        $titulo = $_POST['titulo'];
        $fecha = date("Y/m/d");
        $completada = false;

        if (isset($titulo)) {
            if (insertar_tarea($conexion, $titulo, $completada, $fecha)) {
                $mensaje = "Tarea insertada con exito!";
            } else {
                $mensaje = "Error al insertar tarea";
            }
        }

        cerrar_db($conexion);
        $_SESSION['mensaje'] = $mensaje;
        header('Location: index.php');
        exit();
    }

    // Edicion de tareas

    if (isset($_POST['accion']) && $_POST['accion'] == 'editar') {
        // Recogemos los datos del formulario en variables
        $id = (int)$_POST['id_edicion'];
        $titulo = $_POST['titulo'];
        $completada = $_POST['completada'];

        var_dump($titulo);

        if (!empty($titulo)) {
            // Llamamos a la funcion de actualizar
            if (actualizar_tarea($conexion, $id, $titulo, $completada)) {
                $mensaje = "Tarea actualizada con éxito!";
            } else {
                $mensaje = "ERROR: No se pudo actualizar la tarea";
            }
        } else {
            $mensaje = "ERROR: Datos inválidos para actualizar.";
        }

        cerrar_db($conexion);
        $_SESSION['mensaje'] = $mensaje;
        header('Location: index.php');
        exit();
    }

    cerrar_db($conexion);
}

// ------ METODO GET -------

if (isset($_GET['accion']) && $_GET['accion'] === 'borrar' && isset($_GET['id'])) {
    $conexion = conectar_db();
    if (!$conexion) {
        $mensaje = "ERROR: No se pudo conectar a la base de datos.";
        $_SESSION['mensaje'] = $mensaje;
        header('Location: index.php');
        exit();
    }

    // Recogemos el ID de la tarea a borrar
    $id_a_borrar = (int)$_GET['id'];
    // Llamamos a la funcion de borrar
    if (eliminar_tarea($conexion, $id_a_borrar)) {
        $mensaje = "Tarea eliminada!";
    } else {
        $mensaje = "ERROR: No se pudo eliminar la tarea.";
    }

    cerrar_db($conexion);
    $_SESSION['mensaje'] = $mensaje;
    header('Location: index.php');
    exit();
}
