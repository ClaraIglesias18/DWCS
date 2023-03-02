<?php
require_once('Usuario.php');
require_once('Evento.php');
require_once('UsuarioMysql.php');
require_once('SelectorPersistente.php');
session_start();

if (!isset($_SESSION['bdd'])) {
    header("location:selector.php");
    exit();
} else {
    $usuario = SelectorPersistente::getUsuarioPersistente($_SESSION['bdd']);
}



$mensaje = "";
/*
$usuario = new Usuario(3, "clara", "clara@gmail.com", "abc123.", 0, true);
$evento = new Evento(null, null, "Evento 1");
*/
/*$_SESSION['usuario'] = $usuario;
$_SESSION['evento'] = $evento;
*/
//$mensaje = var_dump($_SESSION['usuario']);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['correo']) && isset($_POST['password'])) {

    $correo = $_POST['correo'];
    $password = $_POST['password'];

    if ($usuario->comprobarUsuario($correo, $password) != null) {

        $idUsuario = $usuario->comprobarUsuario($correo, $password)[0];

        $_SESSION['usuario'] = $correo;
        $_SESSION['idUsuario'] = $idUsuario->id_usuario;
        $mensaje = "Usuario registrado";
        
        if($idUsuario->rol == 1) {
            header("location:admin.php");
            exit();
        } else {
            header("location:index.php");
            exit();
        }
        
    } else {
        $mensaje = "Usuario o contraseña incorrectos";
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
    <div><?= $mensaje ?></div>
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