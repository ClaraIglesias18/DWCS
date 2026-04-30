<?php
session_start();
require_once 'db.php';
require_once 'funciones_tests.php';
require_once 'funciones_test_preguntas.php';

if(!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: panel.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['accion']) && $_POST['accion'] == 'crear') {
        $titulo = $_POST['titulo'];
        if(crear_test($conexion, $titulo)) {
            $_SESSION['msg'] = "Test creado con exito";
        } else {
            $_SESSION['msg'] = "Error al crear test";
        }

    }

    if(isset($_POST['accion']) && $_POST['accion'] == 'editar') {
        $id_test = $_POST['id_test'];
        $titulo = $_POST['titulo'];
        if(editar_test($conexion, $id_test, $titulo)) {
            $_SESSION['msg'] = "Test editado con exito";
        } else {
            $_SESSION['msg'] = "Error al editar test";
        }
    }

    header('Location: panel.php');
    exit();

}