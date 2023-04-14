<?php
require_once('../model/SelectorPersistente.php');
session_start();

if (!isset($_SESSION['bdd'])) {
    header(("location:selector.php"));
    exit();
}

$salida = "";
$usuario = SelectorPersistente::getUsuarioPersistente($_SESSION['bdd']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['correo']) && isset($_POST['password'])) {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    if ($usuario->comprobarUsuario($correo, $password)) {
        $usuarioRecuperado = $usuario->comprobarUsuario($correo, $password);
        $_SESSION['rol'] = $usuarioRecuperado->getRol();
        $_SESSION['correo'] = $usuarioRecuperado->getCorreo();
        $_SESSION['idUsuario'] = $usuarioRecuperado->getIdUsuario();

        if ($_SESSION['rol'] == 1) {
            header("location:admin.php");
            exit();
        } else {
            header("location:../index.php");
            exit();
        }
    } else {
        $salida = "Usuario o contraseña incorrectos";
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

<body class="d-flex justify-content-center align-items-center flex-column">
    <h1 class="text-center bg-warning w-100 h-100">Agenda de eventos</h1>
    <!--<div><?= $salida ?></div>
    <form action="" method="post">
        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Entrar">
    </form>
    <a href="registro.php" class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;">Registrarse</a>
    </br>
    <a href="cerrarSesion.php" class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;">Cerrar Sesion</a>-->
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <form action="" method="post" class="card-body p-5 text-center">

                        <h3 class="mb-5">Login</h3>

                        <div class="form-outline mb-4">
                            <input type="email" name="correo" id="correo" class="form-control form-control-lg" required />
                            <label class="form-label" for="correo">Email</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" name="password" id="password" class="form-control form-control-lg" required />
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>

                        <hr class="my-4">
                        <a href="registro.php" class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;">Registrarse</a>
                        <a href="cerrarSesion.php" class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;">Cambiar BDD</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>