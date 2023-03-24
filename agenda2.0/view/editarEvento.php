<?php
require_once('../model/Evento.php');
require_once('../model/SelectorPersistente.php');
require_once('../model/EventoMysql.php');

session_start();

$salida = " ";
$evento = SelectorPersistente::getEventoPersistente($_SESSION['bdd']);
$idEvento = $_GET['idEvento'];

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

<body>
    <h2>Editar <?= $eventoObj->getNombre() ?></h2>
    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="<?= $eventoObj->getNombre() ?>">
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="datetime-local" name="fecha_inicio" id="fecha_inicio">
        <label for="fecha_fin">Fecha de fin:</label>
        <input type="datetime-local" name="fecha_fin" id="fecha_fin">
        <input type="submit" value="Editar">
    </form>
    <a href="privado.php">Volver</a>
</body>

</html>