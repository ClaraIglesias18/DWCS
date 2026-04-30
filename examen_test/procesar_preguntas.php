<?php
session_start();
require_once 'db.php';
require_once 'funciones_preguntas';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['accion']) && $_POST['accion'] == 'crear') {
        $enunciado = $_POST['titulo'];
        $op_a = $_POST['op_a'];
        $op_b = $_POST['op_b'];
        $op_c = $_POST['op_c'];
        $correcta = $_POST['correcta'];

        if(crear_pregunta($conexion, $enunciado, $op_a, $op_b, $op_c, $correcta)) {
            $_SESSION['msg'] = "Pregunta creada con exito";
        } else {
            $_SESSION['msg'] = "Error al crear pregunta";
        }

        header('Location: crear_preguntas');
        exit();
    }
    
    if(isset($_POST['accion']) && $_POST['accion'] == 'editar') {
        $id_pregunta = $_POST['id_pregunta'];
        $enunciado = $_POST['enunciado'];
        $op_a = $_POST['op_a'];
        $op_b = $_POST['op_b'];
        $op_c = $_POST['op_c'];
        $correcta = $_POST['correcta'];

        if(actualizar_pregunta($conexion, $id_pregunta, $enunciado, $op_a, $op_b, $op_c, $correcta)) {
            $_SESSION['msg'] = "Pregunta actualizada con exito";
        } else {
            $_SESSION['msg'] = "Error al actualizar pregunta";
        }

        header('Location: panel_preguntas.php');
        exit();
    }

    if(isset($_GET['id_pregunta'])) {
        $id_pregunta = $_GET['id_pregunta'];
        if(eliminar_pregunta($conexion, $id_pregunta)) {
            $_SESSION['msg'] = "Pregunta eliminada con exito";
        } else {
            $_SESSION['msg'] = "Error al eliminar pregunta";
        }

        header('Location: panel_preguntas.php');
        exit();
    }
}