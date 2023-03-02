<?php
require_once('SelectorPersistente.php');
require_once('Usuario.php');
require_once('UsuarioMysql.php');

session_start();

if (isset($_SESSION['bdd'])) {
    $bdd = $_SESSION['bdd'];
    $usuario = SelectorPersistente::getUsuarioPersistente($bdd);
} else {
    header("location:selector.php");
    exit();
}

//CREACION DE USUARIO

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['password'])) {

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $usuarioObj = new Usuario(null, $nombre, $correo, $password, 0, false);

    $usuario->guardar($usuarioObj);
    header("location:login.php");
    exit();

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
    <title>Registro de Usuario</title>
</head>

<body>
    <h1>Registro de Usuario</h1>
    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Registrar">
    </form>
</body>

</html>