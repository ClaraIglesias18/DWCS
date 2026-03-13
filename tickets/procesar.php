<?php
session_start();
require_once('bd.php');
require_once('funciones_usuario.php');
require_once('funciones_incidencias.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //---------- USUARIOS ---------    
    if (isset($_POST['accion']) && $_POST['accion'] == 'registrar') {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rol = $_POST['rol'];

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        //llamar a funcion de bdd para insercion de usuario
        if (obtener_usuario_por_email($conexion, $email)) {
            $msg = "El email ya esta en uso";
            $_SESSION['msg'] = $msg;
            header("Location: registro.php");
            exit();
        } else {
            if (registrar_usuario($conexion, $nombre, $email, $password_hash, $rol)) {
                $msg = "Usuario registrado correctamente";
            } else {
                $msg = "Error al regsitrar usuario";
            }

            $_SESSION['msg'] = $msg;
            header('Location: index.php');
            exit();
        }
    }

    if (isset($_POST['accion']) && $_POST['accion'] == 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (verificar_login($conexion, $email, $password)) {
            $usuario = obtener_usuario_por_email($conexion, $email);

            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['rol'] = $usuario['rol'];

            if ($usuario['rol'] == 'tecnico') {
                header('Location: panel_tecnico.php');
                exit();
            } else if ($usuario['rol'] == 'empleado') {
                header('Location: panel_empleado.php');
                exit();
            }
        } else {
            $msg = "Credenciales incorrectas";
            $_SESSION['msg'] = $msg;
            header('Location: index.php');
            exit();
        }
    }

    if (isset($_POST['accion']) && $_POST['accion'] == 'insertar_incidencia') {
        $usuario_id = $_POST['usuario_id'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $prioridad = $_POST['prioridad'];
        $estado = $_POST['estado'];

        if (insertar_incidencia($conexion, $usuario_id, $titulo, $descripcion, $prioridad, $estado)) {
            $msg = "Incidencia insertada con exito";
        } else {
            $msg = "Error al insertar incidencia";
        }

        $_SESSION['msg'] = $msg;
        header('Location: panel_empleado.php');
        exit();
    }

    if(isset($_POST['accion']) && $_POST['accion'] == 'modificar_estado') {
        $id_incidencia = $_POST['id_incidencia'];
        $estado = $_POST['nuevo_estado'];

        if(modificar_estado($conexion, $id_incidencia, $estado)) {
            $msg = "Estado modificado correctamente";
        } else {
            $msg = "Error al modificar el estado";
        }

        $_SESSION['msg'] = $msg;
        header('Location: panel_tecnico.php');
        exit();
    }
}
