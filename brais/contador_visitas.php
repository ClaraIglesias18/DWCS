<?php
session_start();

if(!isset($_SESSION['cont'])) {
    $_SESSION['cont'] = 0;
}

$_SESSION['cont']++;
$cont = $_SESSION['cont'];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    session_destroy();
    header('Location: contador_visitas.php');
    exit();
}

?>
<!DOCTYPE html>
<html>
    <body>
        <h2>Contador de visitas</h2>
        <p>Numero de visitas: <?= $cont ?></p>
        <form action="contador_visitas.php" method="POST">
            <button type="submit" name="cerrar">Cerrar Sesion</button>
        </form>
        
    </body>
</html>