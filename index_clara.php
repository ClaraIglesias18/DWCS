<?php
session_start();

//Variables
//Crea la constante PALABRA con el array "suerte","GANAR","perder","aprobar"  (1 punto)

$palabras = ["suerte", "GANAR", "perder", "aprobar"];
$palabra = "APROBAR";
$palabra_oculta = "______"; //Tantos guiones como letras tiene $palabra
$letras = [];  // Letras jugadas por el jugador en la partida actual
$vidas = 7; //Vidas de las que dispone el jugador para adivinar la $palabra
$mensaje = "";  //Mensajes a mostrar el jugador: letra repetida, ha gando, ha perdido, ...
$partidas_jugadas = 0;  //Partidas totales jugadas por el jugador
$partidas_ganadas = 0; //Partidas ganadas por el jugador

//Código que necesites incluir y no este definido --> (0,25 puntos)

//-------
//Funciones necesarias para desarrollar el juego
/**
 * posiscionesLetra
 * Función que devuelve las posiciones de la "letra" enviada en la palabra a adivinar
 * (2 puntos)
 * @param  mixed $palabra palabra que se ha de acertar
 * @param  mixed $letra letra enviada por el jugador
 * @return mixed Devuelve "false" si no se encuentra la letra en la palabra,
 *               en otro caso devuelve un "array" con las posiciones de esta
 */
 function posicionesLetra(&$palabra, &$letra) {
    $posiciones = [];
    for($i = 0; $i < strlen($palabra); $i++) {
        if($letra == $palabra[$i]) {
            array_push($posiciones, $i);
        }
    }

    if(empty($posiciones)) {
        return false;
    } else {
        return $posiciones;
    }
 }

//
/**
 * colocarletras
 *  Función que coloca la letra en sus posiciones en la palabra oculta
 *      ej:)    palabra a adivinar "SOL" letra= "O" palabra_oculta="___" return "_O_"
 * (1 punto)
 * @param  mixed $palabra_oculta  palabra que contiene guiones y que serán sustituidos en esta función
 * @param  mixed $posiciones posiciones donde se encuentra la letra en la palabra a adivinar
 * @param  mixed $letra letra a colocar en la palabra
 * @return string palabra oculta con la letra en sus posiciones  
 */

 function colocarLetras(&$palabra_oculta, &$posiciones, &$letra)  {
    for($i = 0; $i < strlen($palabra_oculta); $i++) {
        substr_replace($palabra_oculta, $letra, $posiciones[$i], 1);
    }
 }


/**
 * cargarestadojuego
 *  Carga los datos del juego necesarios de la anterior jugada
 * (1 punto)
 * @param  mixed $palabra palabra a adivinar por el jugador
 * @param  mixed $palabra_oculta palabra con la longitud de la $palabra que contiene _ en lugar de las letras
 * @param  mixed $letras letras jugadas por el jugador en la partida actual
 * @param  mixed $vidas vidas que le restan al jugador en la partida actual
 * @param  mixed $partidas_jugadas número de partidas jugadas por el jugador
 * @param  mixed $partidas_ganadas número de partidas ganadas por el jugador
 * @return void
 */

 function cargarEstadoJuego(&$palabra, &$palabra_oculta, &$vidas, &$letras, &$partidas_jugadas, &$partidas_ganadas) {
        $palabra = $_SESSION['palabra'];
        $vidas = $_SESSION['vidas'];
        $letras = $_SESSION['letras'];
        $palabra_oculta = $_SESSION['palabra_oculta'];
        $partidas_jugadas = $_COOKIE['partidas_jugadas'];
        $partidas_ganadas = $_COOKIE['partidas_ganadas'];
 }

/**
 * inciarjuego
 * (1 punto)
 * obtiene la $palabra al azar del array PALABRAS
 * crea la palabra_oculta a partir de la palabra generada al azar
 * inicializa el array de $letras jugadas en la partida
 * inicializa el numero de $vidas a 7
 * 
 * En caso de ganar o perder una partida actualiza el número de partidas jugadas y ganadas
 * los parametros $ganar, $partidas_jugadas y $partidas_ganadas son opcionales, en caso de no ser
 * necesarios su valor por defecto será null
 *
 * @param  mixed $palabra palabra a adivinar por el jugador
 * @param  mixed $palabra_oculta palabra con la longitud de la $palabra que contiene _ en lugar de las letras
 * @param  mixed $letras letras jugadas por el jugador en la partida actual
 * @param  mixed $vidas vidas que le restan al jugador en la partida actual
 * @param  mixed $ganar [default null] Permite indicar si se ha ganado o perdio una partida (true, false)
 * @param  mixed $partidas_jugadas [default null] número de partidas jugadas por el jugador
 * @param  mixed $partidas_ganadas [default null] número de partidas ganadas por el jugador
 * @return void
 */
function iniciarJuego(&$palabras, &$palabra_oculta, &$palabra, &$vidas, &$letras, &$partidas_jugadas, &$partidas_ganadas) {
    if(!isset($_SESSION['palabra']) || !isset($_SESSION['vidas'])) {
        $partidas_jugadas++;
        $azar = random_int(0, count($palabras) - 1);
        $palabra = strtoupper($palabras[$azar]);
        
        $_SESSION['palabra_oculta'] = $palabra_oculta;
        $_SESSION['letras'] = $letras;
        $_SESSION['palabra'] = $palabra;
        $_SESSION['vidas'] = $vidas;
        setcookie('partidas_jugadas',$partidas_jugadas, time() + 3600);
        setcookie('partidas_ganadas',$partidas_ganadas, time() + 3600);
    } else {
        cargarEstadoJuego($palabra, $palabra_oculta, $vidas, $letras, $partidas_jugadas, $partidas_ganadas);
    }


}

/**
 * guardarestadojuego
 * 
 * Guarda el estado de la partida para que se pueda continuar el juego en la próxima llamada a la página
 * (0,5 puntos)
 * @param  mixed $palabra palabra a adivinar por el jugador
 * @param  mixed $palabra_oculta  palabra con la longitud de la $palabra que contiene _ en lugar de las letras
 * @param  mixed $letras letras jugadas por el jugador en la partida actual
 * @param  mixed $vidas vidas que le restan al jugador en la partida actual
 * @return void
 */

function guardarEstadoJuego(&$palabra, &$palabra_oculta, &$letras, &$vidas) {
    $_SESSION['palabra'] = $palabra;
    $_SESSION['palabra_oculta'] = $palabra_oculta;
    $_SESSION['letras'] = $letras;
    $_SESSION['vidas'] = $vidas;
}



//Control del juego (2,25 puntos)
/*
Utiliza aquí las funciones creadas anteriormente y haz que el juego funcione
*/

if (!isset($_COOKIE['partidas_jugadas'])) {
    iniciarJuego($palabras, $palabra_oculta, $palabra, $vidas, $letras, $partidas_jugadas, $partidas_ganadas);
} 

if($_SERVER["REQUEST_METHOD"] == "POST" && $vidas > 1) {
    $letra = strtoupper($_POST['letra']);
    array_push($letras, $letra);

    if(posicionesLetra($palabra, $letra)) {
        $posiciones = posicionesLetra($palabra, $letra);
        colocarLetras($palabra_oculta, $posiciones, $letra);
    } else {
        $vidas--;
    }

    guardarEstadoJuego($palabra, $palabra_oculta, $letras, $vidas);

    if(!str_contains($palabra_oculta, "_")) {
        $mensaje = "Enhorabuena, has ganado!";
        session_destroy();
        $partidas_ganadas++;
        iniciarJuego($palabras, $palabra_oculta, $palabra, $vidas, $letras, $partidas_jugadas, $partidas_ganadas,);
    }

} else if($vidas = 1) {
    $mensaje = "No te quedan vidas, has perdido";
    session_destroy();
    iniciarJuego($palabras, $palabra_oculta, $palabra, $vidas, $letras, $partidas_jugadas, $partidas_ganadas);
}






//Mostrar datos (1 punto)

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego ahorcado</title>
</head>
<body>
    <div>Mesajes: <?=$mensaje//Muestra aquí los mensajes si son necesaior ?> </div>
    <div>Letras jugadas: <?=$letras//Muestra aquí las letras juegadas por el jugador en la partida actual ?></div>
    <div>Palabra: <?=$palabra_oculta//Muestra $palabra_oculta?>  Longitud: <?=strlen($palabra)//indica la longitud de la palabra oculta?></div>
    <div>Vidas: <?=$vidas//muestra el número de $vidas que le restan al jugador en la partida actual?></div>
    <form action="" method="post">
        <input type="text" name="letra" id="letra">
        <input type="submit" value="Comprobar">
    </form>
    <div>Partidas ganadas: <?=$partidas_ganadas//muestra $partidas_ganadas?>  / Partidas jugadas: <?=$partidas_jugadas//muestra $partidas_jugadas?></div>
    <div>Palabra: <?=$palabra//muestra la palabra a adivinar para ayudarte a dupurar el programa?></div>

</body>
</html>
