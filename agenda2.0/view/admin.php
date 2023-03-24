<?php
require_once('../model/Usuario.php');
require_once('../model/UsuarioMysql.php');
require_once('../model/SelectorPersistente.php');

session_start();

if (!isset($_SESSION['correo'])) {
    header("location:login.php");
    exit();
}
$salida = " ";
$usuario = SelectorPersistente::getUsuarioPersistente($_SESSION['bdd']);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['password'])) {
    $usuarioArr = [];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    array_push($usuarioArr, $nombre, $correo, $password);

    $usuario->create($usuarioArr);
}


foreach ($usuario->getAll($usuario) as $usuarios) {
    $salida .= $usuarios->getNombre() . "  " . $usuarios->getCorreo()
        . "   " . $usuarios->getPassword() . "   "
        . "<a href='eliminarUsuario.php?idUsuario=" . $usuarios->getIdUsuario() . "'> Eliminar </a>"
        . "<a href='editarUsuario.php?idUsuario=" . $usuarios->getIdusuario() . "'> Editar </a>" . "</br>";
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
    <title>Pagina de admin</title>
</head>
<body>
    <h1>Página de admin</h1>
    <a href="cerrarSesion.php">Cerrar Sesion</a>
    <h2>Creacion de usuarios</h2>
    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo" required>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Crear">
    </form>
    </br>
    <h2>Lista de usuarios</h2>
    <?= $salida ?>
</body>
</html>