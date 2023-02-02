<?php
require_once('Usuario.php');
require_once('Evento.php');
session_start();
$mensaje ="";

$usuario = new Usuario(3, "clara", "clara@gmail.com", "abc123.", 0, true);
$evento = new Evento(null, null, "Evento 1");

$_SESSION['usuario'] = $usuario;
$_SESSION['evento'] = $evento;

//$mensaje = var_dump($_SESSION['usuario']);


if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['correo'])&& isset($_POST['password']) ) {
    
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $usuario = $_SESSION['usuario'];

    if($usuario->validarUsuario($correo, $password)) {
        $mensaje = "Usuario registrado";
        header("location:index.php");
    } else {
        $mensaje = "Usuario no registrado";
    }
    

}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div><?=$mensaje?></div>
    <form action="" method="post">
        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"  required>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>