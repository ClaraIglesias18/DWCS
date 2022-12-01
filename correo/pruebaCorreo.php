<?php

require_once('Envio.php');
require_once('Correo.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['asunto']) && isset($_POST['cuerpo']) && isset($_POST['origen'])) {
    $asunto = $_POST['asunto'];
    $cuerpo = $_POST['cuerpo'];
    $origen = $_POST['origen'];

    $envio = new Envio($asunto, $cuerpo, $origen);
    $correo = new Correo();

    if(!$correo->enviar($envio)) {
        echo "Error";
    } else {
        echo "Enviado";
    }

}
?>