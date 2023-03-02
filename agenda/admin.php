<?php
require_once('Usuario.php');
require_once('UsuarioMysql.php');
require_once('SelectorPersistente.php');

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("location:login.php");
    exit();
}
$salida = " ";
$usuario = SelectorPersistente::getUsuarioPersistente($_SESSION['bdd']);

foreach ($usuario->listar($usuario) as $usuarios) {
    $salida .= $usuarios->getNombre() . "  " . $usuarios->getCorreo() 
        . "   " . $usuarios->getPassword() . "   " 
        ."<a href='eliminarUsuario.php?idUsuario=" .$usuarios->getIdUsuario()."'> Eliminar </a>"
        . "<a href='editarUsuario.php?idUsuario=" .$usuarios->getIdusuario()."'> Editar </a>"."</br>";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de admin</title>
</head>
<body>
    <h1>Página de admin</h1>
    <a href="cerrarSesion.php">Cerrar Sesion</a>
    <h2>Lista de usuarios</h2>
    <?=$salida?>
</body>
</html>