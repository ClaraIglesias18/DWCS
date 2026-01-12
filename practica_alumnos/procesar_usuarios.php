<?php
session_start();
require_once 'db.php';
require_once 'funciones_usuarios.php';

//  ----------------  PETICIONES POST ----------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['accion'] == 'login') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $usuario = verificar_login($conexion, $username, $password);
        mysqli_close($conexion);

        if ($usuario) {
            // Credenciales correctas
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['username'] = $usuario['username'];
            $_SESSION['rol'] = $usuario['rol'];

            if (isset($_POST['recordar'])) {
                // Creamos una cookie que dure 30 días
                // tiempo actual + (60 seg * 60 min * 24 horas * 30 días)
                $duracion = time() + (60 * 60 * 24 * 30);

                // Guardamos solo el nombre de usuario (NUNCA la contraseña)
                setcookie("recordar_username", $username, $duracion);
                setcookie("recordar_password", $password, $duracion);
            } else {
                // Si no marcó el check, borramos la cookie por si existía una anterior
                setcookie("recordar_username", "", time() - 3600);
                setcookie("recordar_password", "", time() - 3600);
            }
            header('Location: index.php');
            exit;
        } else {
            // Credenciales incorrectas
            $msg = "Usuario o contraseña incorrectos.";
            $_SESSION['msg'] = $msg;
            header('Location: login.php');
            exit;
        }
    }

    if ($_POST['accion'] == 'registrar') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nombre = $_POST['nombre'];
        $rol = $_POST['rol'];

        $registro_exitoso = registrar_usuario($conexion, $username, $password, $nombre, $rol);
        mysqli_close($conexion);

        if ($registro_exitoso) {
            $msg = "Usuario registrado correctamente. Por favor, inicie sesión.";
            $_SESSION['msg'] = $msg;
            header('Location: login.php');
            exit;
        } else {
            $msg = "Error al registrar el usuario.";
            $_SESSION['msg'] = $msg;
            header('Location: registro.php');
            exit;
        }
    }
}
