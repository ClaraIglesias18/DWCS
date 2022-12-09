<?php
include_once("usuario.php");
$salida = "";
$dsn = "mysql:dbname=docker_demo;host=docker-mysql";
$usuario = "root";
$password = "root123";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['correo']) && isset($_POST['contraseña'])) {

    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $bd = new PDO($dsn, $usuario, $password);        
    $sql = "select * from usuario where correo = '$correo' && password = '$contraseña';";
    
    $resultado = $bd->query($sql);

    if($resultado->rowCount() == 1) {
        $user = $resultado->fetch();
        $usuario = new Usuario($user['idUsuario'], $user['nombre'], $user['apellidos'], $user['correo'], $user['password']);
        if(!$usuario->validarUsuario($correo, $contraseña)) {
            $salida = "Usuario y/o contraseña incorrectos";
        } else {
            $salida = "Login correcto";
            $_SESSION['correo'] = $usuario->getCorreo();
            header('Location: privado.php');
            exit();
        }
    } else {
        $salida = "El usuario no se encuentra en la base de datos";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Formulario de login</title>
</head>
<body>

<h1>Login</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <label for="correo">Correo:</label><br>
  <input type="text" id="correo" name="correo"><br>
  <label for="contraseña">Contraseña:</label><br>
  <input type="contraseña" id="contraseña" name="contraseña"><br><br>
  <input type="submit" value="Submit">
</form> 

<?=$salida?>
</body>