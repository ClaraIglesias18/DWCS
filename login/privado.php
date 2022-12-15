<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$salida = "";

if(!isset($_SESSION['correo'])) {
    header('Location: login.php');
    exit();
} 

$salida = "PRIVADO";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['correo']) && isset($_POST['contraseña'])) {
    //crear usuario
    $dsn = "mysql:dbname=docker_demo;host=docker-mysql";
    $usuario ="root";
    $password = "root123";
    $bd = new PDO($dsn, $usuario, $password);
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    //$usuario = new Usuario($nombre, $apellidos, $correo, $contraseña);

    $stm = $bd->prepare("INSERT INTO usuario(nombre, apellidos, correo, password) VALUES(:nombre, :apellidos, :correo, :contraseña)");
    $stm->execute([":nombre"=>$nombre, ":apellidos"=>$apellidos, ":correo"=>$correo, ":contraseña"=>$contraseña]);

    if($stm->rowCount() == 1) {
        $salida = "Usuario creado con exito";
    } else {
        $salida = "Error al crear un usuario";
    }

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privado</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre"><br>
        <label for="apellidos">Apellidos:</label><br>
        <input type="text" id="apellidos" name="apellidos"><br>
        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo"><br>
        <label for="contraseña">Contraseña:</label><br>
        <input type="password" id="contraseña" name="contraseña"><br><br>
        <input type="submit" value="Crear usuario">
    </form>
</body>
</html>