<?php
include_once('Evento.php');
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$usuario = $_SESSION['usuario'];
$eventos = unserialize($_SESSION['eventos']);
$salida = " ";


if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $id = $_GET['id'];

    foreach ($eventos as $evento) {
        if ($evento->getIdEvento() == $id) {
            $nombre = $evento->getNombre();
            $fecha_inicio = $evento->getFechaInicio();
            $fecha_fin = $evento->getFechaFin();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id = $_GET['id'];

    foreach ($eventos as $evento) {
        if ($evento->getIdEvento() == $id) {
            if ($_POST['nombre']) {
                $nombre = $_POST['nombre'];
                $evento->setNombre($nombre);
            }

            if ($_POST['fecha_inicio']) {
                $fecha_inicio = new DateTime($_POST['fecha_inicio']);
                $evento->setFechaInicio($fecha_inicio);
            }
            if ($_POST['fecha_fin']) {
                $fecha_fin = new DateTime($_POST['fecha_fin']);
                $evento->setFechaFin($fecha_fin);
            }

            $_SESSION['eventos'] = serialize($eventos);
            header("location:privado.php");
            exit();
        }
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
    <title>Editar Evento</title>
</head>

<body>
    <h2>Editar <?= $nombre ?></h2>
    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="<?= $nombre ?>" required>
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="datetime-local" name="fecha_inicio" id="fecha_inicio">
        <label for="fecha_fin">Fecha de fin:</label>
        <input type="datetime-local" name="fecha_fin" id="fecha_fin">
        <input type="submit" value="Editar">
    </form>
    <a href="privado.php">Volver</a>
</body>

</html>