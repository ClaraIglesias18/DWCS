<?php

require_once('Envio.php');
require_once('Correo.php');
$salida = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['asunto']) && isset($_POST['cuerpo']) && isset($_POST['origen'])) {
    $asunto = $_POST['asunto'];
    $cuerpo = $_POST['cuerpo'];
    $origen = $_POST['origen'];

    $envio = new Envio($asunto, $cuerpo, $origen);
    $correo = new Correo();

    if(!$correo->enviar($envio)) {
        $salida = "Error";
    } else {
        $salida = "Enviado";
    }

}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de correo</title>
</head>
<body>
    <form action="" method="post">
        <labebl for="origen">De: </labebl>
        <input type="text" name="origen">
        <br>
        <label for="asunto">Asunto: </label>
        <input type="text" name="asunto">
        <br>
        <label for="cuerpo">Cuerpo: </label>
        <br>
        <textarea rows="5" cols="10" name="cuerpo"></textarea>
        <br>
        <input type="submit" name="Enviar">
    </form>
    <?=$salida?>
    
</body>
</html>