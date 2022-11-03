<?php
session_start();
$intentos = 5;
$historico = array();

if(!isset($_SESSION['numAl'])) {
    $_SESSION['numAl'] = random_int(0, 100);
}

if(!isset($_SESSION['intentos'])) {
    $_SESSION['intentos'] = $intentos;
} else {
    $intentos = $_SESSION['intentos'];
}

if(!isset($_SESSION['historico'])) {
    $_SESSION['historico'] = $historico;
} else {
    $historico = $_SESSION['historico'];
}

$salida = "Te quedan ".$intentos. " intentos"
        . "<br>". "Historico de intentos: " . implode(", ", $_SESSION['historico']);

if ($_SERVER["REQUEST_METHOD"] == "POST" && $intentos > 1){
  //  array_push($historico, $_POST['numero']);
    $historico[] = $_POST['numero'];
    $_SESSION['historico'] = $historico;
    if($_POST['numero'] > $_SESSION['numAl']) {
        $salida = "El numero introducido es mayor";
    } else if($_POST['numero'] < $_SESSION['numAl']) {
        $salida = "El numero introducido es menor";
    } else {
        $salida = "Enhorabuena has acertado!";
        session_destroy();
    }

    $intentos--;
    $salida .= "<br>"." Intentos restantes: " . $intentos
            . "<br>". "Historico de intentos: " . implode(",", $_SESSION['historico']);
    $_SESSION['intentos'] = $intentos;
} else if($intentos == 1){
    array_push($historico, $_POST['numero']);
    $_SESSION['historico'] = $historico;
    $salida = "No te quedan mas intentos, el numero era: " . $_SESSION['numAl']
            . "<br>". "Historico de intentos: " . implode(",", $_SESSION['historico']);
    session_destroy();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adivina numero</title>
</head>
<body>
    <h1>Adivina el numero</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="number" name="numero" id="numero">
        <input type="submit" name="Enviar">
    </form>
    <?=$salida?>
</body>
</html>