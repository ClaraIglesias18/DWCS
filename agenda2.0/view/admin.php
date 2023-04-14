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
    $salida .= "<tr>
                <td>" . $usuarios->getNombre() . "</td>
                <td>" . $usuarios->getCorreo() . "</td>
                <td>" . $usuarios->getPassword() . "
                <a href='eliminarUsuario.php?idUsuario=" . $usuarios->getIdUsuario() . "' class='btn btn-primary' style='background-color: #dd4b39; border: 0px;'> Eliminar </a>
                <a href='editarUsuario.php?idUsuario=" . $usuarios->getIdusuario() . "' class='btn btn-primary' style='background-color: #3b5998; border: 0px;'> Editar </a></td>
                </tr>";
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
<body class="d-flex justify-content-center align-items-center flex-column">
<h1 class="text-center bg-warning w-100 h-100">Pagina de admin</h1>
    <div>
        <a href="cerrarSesion.php" class="btn btn-primary" style="background-color: #dd4b39; border: 0px;">Cerrar Sesion</a>
    </div>
    <h2>Creacion de usuarios</h2>
    <form action="" method="post" class="d-flex flex-column" style="width: 20%; margin-left:10px;">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo" required>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Crear">
    </form>
    <div class="d-flex justify-content-center align-items-center flex-column">
        <h2 style="margin-left:10px;">Lista de usuarios</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Contraseña</th>
                </tr>
                <?= $salida ?>
            </thead>
        </table>
            
    </div>
</body>
</html>