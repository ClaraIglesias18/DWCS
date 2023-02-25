<?php
require_once('Evento.php');
require_once('SelectorPersistente.php');

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("location:login.php");
    exit();
}

$evento = new EventoMysql;

$usuario = $_SESSION['usuario'];

if(!isset($_SESSION['eventos'])) {
    $eventos = [];
} else {
    $eventos = unserialize($_SESSION['eventos']);
}
$salida = " ";


if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['nombre'])&& isset($_POST['fecha_inicio']) ) {
    
    $nombre = $_POST['nombre'];
    $fecha_inicio = new DateTime($_POST['fecha_inicio']);
    $fecha_fin = null;

    if(isset($_POST['fecha_fin'])) {
        $fecha_fin = new DateTime($_POST['fecha_fin']);
    }

    $eventoObj = new Evento(0, null, $nombre, $fecha_inicio, $fecha_fin);

    $evento = SelectorPersistente::getEventoPersistente();

    $evento->guardar($eventoObj);

    
}

foreach($evento->listar() as $evento) {

    $salida .= $evento . "</br>";

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
   <h2>Crear un evento</h2> 
   <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="datetime-local" name="fecha_inicio" id="fecha_inicio"  required>
        <label for="fecha_fin">Fecha de fin:</label>
        <input type="datetime-local" name="fecha_fin" id="fecha_fin">
        <input type="submit" value="Agregar">
    </form>
    </br>
    <div>
        <h2>Lista de eventos</h2>
        <?=$salida?>
    </div>
</body>
</html>