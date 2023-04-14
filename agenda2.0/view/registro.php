<?php
require_once('../model/Usuario.php');
require_once('../model/UsuarioMysql.php');
require_once('../model/SelectorPersistente.php');

session_start();

$usuario = SelectorPersistente::getUsuarioPersistente($_SESSION['bdd']);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['password'])) {
    $usuarioArr = [];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    array_push($usuarioArr, $nombre, $correo, $password);

    $usuario->create($usuarioArr);

    header('location:login.php');
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
    <title>Registro</title>
</head>

<body>
    <h1>Página de registro</h1>
    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo" required>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Registro">
    </form>
    </br>
    <a href="cerrarSesion.php">Cerrar Sesion</a>
</body>

</html>