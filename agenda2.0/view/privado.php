<?php
require_once('../model/SelectorPersistente.php');

session_start();

if (!isset($_SESSION['idUsuario'])) {
    header("location:login.php");
    exit();
}

$correo = $_SESSION['correo'];
$idUsuario = $_SESSION['idUsuario'];

$evento = SelectorPersistente::getEventoPersistente($_SESSION['bdd']);
$usuario = SelectorPersistente::getUsuarioPersistente($_SESSION['bdd']);

$usuarioObj = $usuario->getById($idUsuario);

$salida = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre']) && isset($_POST['fecha_inicio'])) {
    $eventoArr = [];
    $nombre = $_POST['nombre'];
    $fecha_inicio = new DateTime($_POST['fecha_inicio']);
    $fecha_fin = new DateTime($_POST['fecha_inicio']);

    if (!isset($_POST['fecha_fin'])) {
        $fecha_fin->add(new DateInterval('PT01H'));
    } else {
        $fecha_fin = new DateTime($_POST['fecha_fin']);
    }

    array_push($eventoArr, $nombre, $fecha_inicio, $fecha_fin, $idUsuario);

    $evento->create($eventoArr);
}

foreach ($evento::getAll($idUsuario) as $event) {

    $salida .= "<tr>
                <td>" . $event->getNombre() . "</td> 
                <td>" . $event->getFechaInicio()->format('Y-m-d H:i:s') . "</td>
                <td>" . $event->getFechaFin()->format('Y-m-d H:i:s') . " 
                <a href='eliminarEvento.php?idEvento=" . $event->getIdEvento() . "' class='btn btn-primary' style='background-color: #dd4b39; border: 0px;'> Eliminar </a>
                <a href='editarEvento.php?idEvento= " . $event->getIdEvento() . "' class='btn btn-primary' style='background-color: #3b5998; border: 0px;'> Editar </a></td>
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
    <title>Agenda</title>
</head>

<body class="d-flex justify-content-center align-items-center flex-column">
    <h1 class="text-center bg-warning w-100 h-100">Agenda de <?= $usuarioObj->getNombre() ?></h1>
    <div>
        <a href="cerrarSesion.php" class="btn btn-primary" style="background-color: #dd4b39; border: 0px;">Cerrar Sesion</a>
        <a href="editarUsuario.php?idUsuario=<?= $idUsuario ?>" class="btn btn-primary" style="background-color: #3b5998; border: 0px;">Editar Cuenta</a>
    </div>
    <h2 style="margin-left:10px;">Crear un evento</h2>
    <form action="" method="post" class="d-flex flex-column" style="width: 20%; margin-left:10px;">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="datetime-local" name="fecha_inicio" id="fecha_inicio" required>
        <label for="fecha_fin">Fecha de fin:</label>
        <input type="datetime-local" name="fecha_fin" id="fecha_fin">
        <input type="submit" value="Agregar">
    </form>
    <div class="d-flex justify-content-center align-items-center flex-column">
        <h2 style="margin-left:10px;">Lista de eventos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha de Inicio</th>
                    <th scope="col">Fecha de Fin</th>
                </tr>
            </thead>
            <?= $salida ?>
        </table>

    </div>
</body>

</html>