<?php
session_start();
require_once 'funciones.php';

// -------- MANEJO DE PETICIONES POST --------
// PROCESAMOS EL FORMULARIO PARA AÑADIR O ACTUALIZAR UN PRODUCTO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = conectar_db();
    if (!$conexion) {
        $mensaje = "ERROR: No se pudo conectar a la base de datos.";
        header("Location: login.php?mensaje=" . urlencode($mensaje));
        exit();
    }

    // Comprobamos si nos llega una peticion POST con el campo de accion igual a 'registro'(que viene de la pagina de registro.php)
    // --- LÓGICA DE REGISTRO ---
    if (isset($_POST['accion']) && $_POST['accion'] === 'registro') {
        // Recogemos los datos del formulario en variables
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];
        $tipo = $_POST['tipo']; // Viene del select del formulario

        if (insertar_usuario($conexion, $nombre, $apellidos, $correo, $contraseña, $tipo)) {
            $mensaje = "¡Usuario con correo **$correo** registrado con éxito!";
            header("Location: login.php?mensaje=" . urlencode($mensaje));
        } else {
            $mensaje = "ERROR: No se pudo registrar el usuario.";
            header("Location: registro.php?mensaje=" . urlencode($mensaje));
        }
        exit();
    }

    // Al no haber entrado en el anterior if, comprobamos si nos llegan peticiones POST para hacer login del usuario por parte de login.php
    // --- LÓGICA DE LOGIN ---
    if (isset($_POST['correo']) && isset($_POST['contraseña'])) {
        $correo = trim($_POST['correo']);
        $pass = trim($_POST['contraseña']);

        $usuario = obtener_usuario_por_correo($conexion, $correo);

        if ($usuario && password_verify($pass, $usuario['contraseña'])) {
            // Guardamos los datos en la sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['tipo'] = $usuario['tipo'];

            // REDIRECCIÓN SEGÚN EL TIPO
            switch ($usuario['tipo']) {
                case 'admin':
                    header("Location: admin.php");
                    break;
                case 'usuario':
                    header("Location: usuario.php");
                    break;
                default:
                    header("Location: login.php");
                    break;
            }
            exit(); 
        } else {
            $mensaje = "ERROR: Correo o contraseña incorrectos.";
            header("Location: login.php?mensaje=" . urlencode($mensaje));
            exit();
        }
    }
}

