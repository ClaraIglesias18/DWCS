<?php
    session_start();
    $min = 1;
    $max = 100;

    //1- generar cookies de numAl y de intentos del usuario
    //2- comprobar el post del formulario html
    //3- implementar funciones para encapsular el codigo
    //4- implemrtar historico de intentos
    //5- crera variable de historico como sesion

    function nuevaPartida(&$numAl, &$intentos) {
        $numAl = random_int(1, 100);
        $_SESSION['numAl'] = $numAl;
        //setcookie('numAl', $numAl, time() + 3600);
        $intentos = 5;
        $_SESSION['intentos'] = $intentos;
        //setcookie('intentos', $intentos, time() + 3600);
    }

    function actualizarIntentos(&$intentos) {
        $intentos--;
        $_SESSION['intentos'] = $intentos;
        //setcookie('intentos', $intentos, time() + 3600);
    }

    function recuperarDatos(&$numAl, &$intentos) {
        $numAl = $_SESSION['numAl'];
        $intentos = $_SESSION['intentos'];
    }

    if(!isset($_SESSION['numAl']) || !isset($_SESSION['intentos'])) {
        nuevaPartida($numAl, $intentos);
    } else {
        recuperarDatos($numAl, $intentos);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && $intentos > 1) {
        $numero = $_POST['numero'];
        actualizarIntentos($intentos);

        if($numero > $numAl) {
            $salida = "El numero introducido es mayor";
        } else if($numero < $numAl) {
            $salida = "El numero introducido es menor";
        } else {
            $salida = "Has acertado, el numero era: " . $numAl;
            nuevaPartida($numAl, $intentos);
        }
    } else if($intentos <= 1) {
        $salida = "Has perdido, el numero era: " . $numAl;
        nuevaPartida($numAl, $intentos); 
    }
       
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Te quedan: <?=$intentos?> intentos</p>
    <form action="" method="post">
        <label for="numero">número</label>
        <input type="number" name="numero" min="<?=$min?>" max="<?=$max?>" id="numero">
        <input type="submit" value="Comprobar">
    </form>
   <p><?=(isset($salida))?$salida:" "?></p> 
   <?=$numAl?>
</body><
</html>