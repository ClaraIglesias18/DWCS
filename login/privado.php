<?php
session_start();
$salida = "";

if(!isset($_SESSION['correo'])) {
    header('Location: login.php');
    exit();
} else {
    //crear usuario
    $salida = "PRIVADO";

    if($_SERVER("REQUEST_METHOD") == "POST" && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['correo']) && isset($_POST['contraseña']))
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
        <input type="submit" value="Submit">
    </form>
</body>
</html>