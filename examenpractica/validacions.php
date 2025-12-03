<?php
    session_start();
    include('funciones.php');

    if(empty($_POST['nombre'])) {
        $_SESSION['error_nombre'] = "";
        header('Location: formulario.php');
        exit();
    } elseif (empty($_POST['pass'])) {
        $_SESSION['nombre'] = $_POST['nombre'];
        $_SESSION['color'] = $_POST['color'];
        $_SESSION['error_pass'] = "";
        header('Location: formulario.php');
        exit();
    } elseif (empty($_POST['color'])) {
        $_SESSION['nombre'] = $_POST['nombre'];
        $_SESSION['color'] = $_POST['color'];
        $_SESSION['error_color'] = "";
        header('Location: formulario.php');
        exit();
    } else {
        $_SESSION['nombre'] = $_POST['nombre'];
        $_SESSION['color'] = $_POST['color'];
        rellenar_tabla($_POST['nombre'], $_POST['color'], $_POST['pass']);
    }

?>