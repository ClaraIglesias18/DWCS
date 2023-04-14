<?php
require_once('../model/Usuario.php');
require_once('../model/SelectorPersistente.php');

session_start();

if(!isset($_SESSION['idUsuario'])) {
    header("location:login.php");
    exit();
}

$usuario = SelectorPersistente::getUsuarioPersistente($_SESSION['bdd']);
$idUsuario = $_GET['idUsuario'];

$usuarioObj = $usuario->getById($idUsuario);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($usuarioObj->getIdUsuario() == $idUsuario) {
        if ($_POST['nombre']) {
            $nombre = $_POST['nombre'];
            $usuarioObj->setNombre($nombre);
        }

        if ($_POST['correo']) {
            $correo = $_POST['correo'];
            $usuarioObj->setCorreo($correo);
        }

        if ($_POST['password']) {
            $password = $_POST['password'];
            $usuarioObj->setPassword($password);
        }
        
        $usuario->modify($usuarioObj);
    }

    if($usuarioObj->getRol() == 1) {
        header("location:admin.php");
        exit();
    } else {
        header("location:privado.php");
        exit();
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
    <title>Editar Usuario</title>
</head>

<body>
    <h2>Editar <?= $usuarioObj->getNombre() ?></h2>
    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="<?= $usuarioObj->getNombre() ?>">
        <label for="fecha_inicio">Correo:</label>
        <input type="text" name="correo" id="correo" placeholder="<?= $usuarioObj->getCorreo()?>">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="Editar">
    </form>
    <a href="privado.php">Volver</a>
</body>

</html>