<?php
require_once('model/DiccionarioMysql.php');
require_once('model/Wordle.php');

session_start();

$partida = new Wordle();

if (isset($_SESSION["partida"])) {
    $partida = unserialize(base64_decode($_SESSION["partida"]));
} else {
    $partida->iniciarJuego();
}

$partidasJugadas = $partida->getPartidasJugadas();
$partidasGanadas = $partida->getPartidasGanadas();
$salida = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["palabra"]) && $_POST["palabra"] != "") {
    $palabraJugada = $_POST["palabra"];
    $arrPalabraJugada = str_split($palabraJugada);
    $salida .= "<div style = 'display:flex; flex-direction:row>'";

    $result = $partida->comprobarLetrasPalabra($palabraJugada);
    $count = 0;

    for ($i = 0; $i < count($arrPalabraJugada); $i++) {
        if ($result[$i] == 2) {
            $count++;
            $salida .= "<p style = 'color:green'>" . $arrPalabraJugada[$i] . "</p>";
        } elseif ($result[$i] == 1) {
            $salida .= "<p style = 'color:yellow'>" . $arrPalabraJugada[$i] . "</p>";
        } else {
            $salida .= "<p style = 'color:grey'>" . $arrPalabraJugada[$i] . "</p>";
        }
    }

    if ($count == 5) {
        $salida = "Enhorabuena! Has ganado la partida.";
        $partida->iniciarJuego();
    } else if ($partida->getVidas() == 0) {
        $salida = "La palabra oculta era: " . $partida->palabraOculta;
        $partida->iniciarJuego();
    } else {
        $salida .= "</div>";
    }
}

$_SESSION["partida"]  = base64_encode(serialize($partida));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Clara</title>
</head>

<body style="display:flex; flex-direction:column">
    <h1>Wordle</h1>
    <div class="resultado">
        <?= $salida ?>
    </div>
    <form action="" method="POST">
        <input type="text" name="palabra" id="palabra">
        <input type="submit" value="Comprobar">
    </form>
    <div class="informacionJuego">
        <div>Partidas Jugadas: <?= $partidasJugadas ?></div>
        <div>Partidas Ganadas: <?= $partidasGanadas ?></div>
    </div>
</body>

</html>