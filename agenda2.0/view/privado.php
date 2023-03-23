<?php
require_once('../model/SelectorPersistente.php');

session_start();

if (!isset($_SESSION['correo'])) {
    header("location:login.php");
    exit();
}

$correo = $_SESSION['correo'];
$idUsuario = $_SESSION['idUsuario'];
$evento = SelectorPersistente::getEventoPersistente($_SESSION['bdd']);

$salida = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre']) && isset($_POST['fecha_inicio'])) {
    $eventoArr = [];
    $nombre = $_POST['nombre'];
    $fecha_inicio = new DateTime($_POST['fecha_inicio']);
    $fecha_fin = null;

    if (isset($_POST['fecha_fin'])) {
        $fecha_fin = new DateTime($_POST['fecha_fin']);
    }

    array_push($eventoArr, $nombre, $fecha_inicio, $fecha_fin, $idUsuario);

    $evento->create($eventoArr);
}

foreach ($evento->getAll($idUsuario) as $eventos) {
    var_dump($eventos);
    /*$salida .= $eventos->getNombre() . "  " . $eventos->getFechaInicio()->format('Y-m-d H:i:s') 
        . "   " . $eventos->getFechaFin()->format('Y-m-d H:i:s') . "   " . $eventos->getIdUsuario() 
        . "    " . $eventos->getIdEvento() . "<a href='eliminar.php?idEvento=" .$eventos->getIdEvento()."'> Eliminar </a>"
        . "<a href='editar.php?idEvento=" .$eventos->getIdEvento()."'> Editar </a>"."</br>";
    */
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
    <title>Agenda</title>
</head>

<body>
    <h1>Agenda</h1>
    <a href="cerrarSesion.php">Cerrar Sesion</a>
    <h2>Crear un evento</h2>
    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="datetime-local" name="fecha_inicio" id="fecha_inicio" required>
        <label for="fecha_fin">Fecha de fin:</label>
        <input type="datetime-local" name="fecha_fin" id="fecha_fin">
        <input type="submit" value="Agregar">
    </form>
    </br>
    <div>
        <h2>Lista de eventos</h2>
        <?= $salida ?>
    </div>
</body>

</html>