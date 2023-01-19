<?php
//variables
$entrada = "";
$salida = " ";

function numeroEntradas(&$entrada) {

    $coma = strpos($entrada, ",");

    if(!isset($entrada)) {

        return 0;

    } elseif ($coma != false) {

        return 2;

    } else {

        return 1;

    }
}

//control de programa
function controlEntrada(&$entrada) {

    //primero buscamos si tiene una coma para diferenciar si
    //se metieron uno o dos valores
    $coma = strpos($entrada, ",");
    
    if(numeroEntradas($entrada) == 0) {
        return true;
    } elseif(numeroEntradas($entrada) == 2) {
        $entradas = explode(",", $entrada);
        if(count($entradas) > 2 || is_nan($entradas[0]) || is_nan($entradas[1]) || $entradas[0] <= 0 || $entradas[1] <= 0) {
            return false;
        } else {
            return true;
        } 
    } else {
        if(is_nan($entrada) || $entrada <= 0) {
            return false;
        } else {
            return true;
        }
    }

}

function generarDni() {
    $letras = ["T","R","W","A","G","M","Y","F","P","D","X","B","N","J","Z","S","Q","V","H","L","C","K","E"];
    
    $nif = random_int(10000000, 99999999);
    $letra = $letras[$nif % 23];

    $dni = $nif + $letra;

    return $dni;
}


if($_SERVER["REQUEST_METHOD"]) {
    $entrada = $_POST['entrada'];

    if(controlEntrada($entrada)){
        if(numeroEntradas($entrada) == 0) {
            $filas = 8;
            $columnas = 8;

            for($i = 0; $i < 8; i++) {
                
            }

        } elseif(numeroEntradas($entrada) == 1) {

        } elseif (numeroEntradas($entrada) == 2) {

        }
    } else {
        $salida = "ERROR. Has introducido mal los datos";
    }


}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <!-- formulario para introducir numero de filas,columnas -->
    <form action="">
        <label for="entrada">Filas,columnas: </label>
        <input type="text" name="entrada"> 
    </form>
</body>
</html>