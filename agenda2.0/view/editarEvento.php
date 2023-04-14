<?php
require_once('../model/Evento.php');
require_once('../model/SelectorPersistente.php');
require_once('../model/EventoMysql.php');

session_start();

$salida = " ";
$evento = SelectorPersistente::getEventoPersistente($_SESSION['bdd']);
$usuario = SelectorPersistente::getUsuarioPersistente($_SESSION['bdd']);
$idEvento = $_GET['idEvento'];
$idUsuario = $_SESSION['idUsuario'];
$usuarioObj = $usuario->getById($idUsuario);
$eventoObj = $evento->getById($idEvento);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($eventoObj->getIdEvento() == $idEvento) {
        if ($_POST['nombre']) {
            $nombre = $_POST['nombre'];
            $eventoObj->setNombre($nombre);
        }

        if ($_POST['fecha_inicio']) {
            $fecha_inicio = new DateTime($_POST['fecha_inicio']);
            $eventoObj->setFechaInicio($fecha_inicio);
        }

        if ($_POST['fecha_fin']) {
            $fecha_fin = new DateTime($_POST['fecha_fin']);
            $eventoObj->setFechaFin($fecha_fin);
        }

        $evento->modify($eventoObj);
    }

    header("location:privado.php");
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
    <title>Editar Evento</title>
</head>

<body class="d-flex justify-content-center align-items-center flex-column">
    <h1 class="text-center bg-warning w-100 h-100">Agenda de <?= $usuarioObj->getNombre() ?></h1>
    <h2>Editar <?= $eventoObj->getNombre() ?></h2>
    <form action="" method="post" class="d-flex flex-column" style="width: 20%; margin-left:10px;">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="<?= $eventoObj->getNombre() ?>">
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="datetime-local" name="fecha_inicio" id="fecha_inicio">
        <label for="fecha_fin">Fecha de fin:</label>
        <input type="datetime-local" name="fecha_fin" id="fecha_fin">
        <input type="submit" value="Editar">
    </form>
    <a href="privado.php" class="btn btn-primary" style="background-color: #3b5998; border: 0px; margin-top:10px">Volver</a>
</body>

</html>