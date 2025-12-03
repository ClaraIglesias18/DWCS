<?php

function validar_usuario($x)
{
    $resultado = 0;

    if ($x != 'Andres') $resultado = 1;

    return $resultado;
}

function validar_pass($x)
{
    $resultado = 0;
    $cont = 0;

    if (strlen($x) < 8 || strlen($x) > 15) {
        $resultado = 1;
    } else {
        for ($i = 0; $i <= strlen($x); $i++) {
            if (is_numeric($x[$i])) {
                $cont++;
            }
        }
        if ($cont == 0) {
            $resultado = 2;
        }
    }

    return $resultado;
}

function rellenar_tabla($nombre, $color, $pass)
{
    $nombre1 = validar_usuario($nombre);
    $pass1 = validar_pass($pass);

    if ($nombre1 == 0 && $pass1 == 0) {

        if (!isset($_SESSION['usuario']['nombre']) || !is_array($_SESSION['usuario']['nombre'])) {
            $_SESSION['usuario']['nombre'] = [];
        }
        if (!isset($_SESSION['usuario']['color']) || !is_array($_SESSION['usuario']['color'])) {
            $_SESSION['usuario']['color'] = [];
        }
        $_SESSION['usuario']['nombre'][] = $nombre;
        $_SESSION['usuario']['color'][] = $color;

        setcookie('color', $color, time() + 3600);

        header('Location: tabla.php');
        exit();
    } elseif ($pass1 == 1) {

        $_SESSION['pass_len'] = "";
        header('Location: formulario.php');
        exit();
    } elseif ($pass1 == 2) {

        $_SESSION['pass_num'] = "";
        header('Location: formulario.php');
        exit();
    } else {

        $_SESSION['usuario_mal'] = "";
        header('Location: formulario.php');
        exit();
    }
}
