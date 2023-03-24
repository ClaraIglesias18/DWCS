<?php
require_once('../model/SelectorPersistente.php');
session_start();

if(!isset($_SESSION['bdd'])) {
    header(("location:selector.php"));
    exit();
}

$salida = "";
$usuario = SelectorPersistente::getUsuarioPersistente($_SESSION['bdd']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['correo']) && isset($_POST['password'])) {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    if($usuario->comprobarUsuario($correo, $password) != null) {
        $usuarioRecuperado = $usuario->comprobarUsuario($correo, $password);
        $_SESSION['rol'] = $usuarioRecuperado->getRol();
        $_SESSION['correo'] = $usuarioRecuperado->getCorreo();
        $_SESSION['idUsuario'] = $usuarioRecuperado->getIdUsuario();

        if($_SESSION['rol'] == 1) {
            header("location:admin.php");
            exit();
        } else {
            header("location:../index.php");
            exit();
        }
    } else {
        $salida = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0
.0/css/bootstrap.min.css">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <div><?= $salida ?></div>
    <form action="" method="post">
        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Entrar">
    </form>
    <a href="registro.php">Registrarse</a>
</body>

</html>