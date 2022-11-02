<?php
$intentos = 5;
$salida = "Te quedan ".$intentos. " intentos";

if(!isset($_COOKIE['numAl'])) {
    setcookie('numAl', random_int(0, 100), time() + 3600);
}

if(!isset($_COOKIE['intentos'])) {
    setcookie('intentos', $intentos, time() + 3600);
} else {
    $intentos = $_COOKIE['intentos'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $intentos > 1){
    if($_POST['numero'] > $_COOKIE['numAl']) {
        $salida = "El numero introducido es mayor";
    } else if($_POST['numero'] < $_COOKIE['numAl']) {
        $salida = "El numero introducido es menor";
    } else {
        $salida = "Enhorabuena has acertado!";
    }

    $intentos--;
    $salida .= " Intentos restantes: " . $intentos;
    setcookie('intentos', $intentos, time() + 3600);
} else if($intentos == 1){
    $salida = "No te quedan mas intentos, el numero era: " . $_COOKIE['numAl'];
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