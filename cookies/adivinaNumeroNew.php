<?php
session_start();

// Función para reiniciar el juego (limpiando las cookies)
function reiniciar_juego() {
    setcookie("secreto", "", time() - 3600); // Borra la cookie del secreto
    setcookie("intentos", "", time() - 3600); // Borra la cookie de intentos
    $_SESSION['historico_intentos'] = []; // Reinicia el histórico de intentos
    header('Location: adivinaNumeroNew.php');
    exit();
}

// Inicialización: Verifica si el juego está en curso, si no, lo inicia.
if (isset($_COOKIE["secreto"]) && isset($_COOKIE["intentos"])) {
    $secreto = (int) $_COOKIE["secreto"];
    $intentos = (int) $_COOKIE["intentos"];
} else {
    $secreto = random_int(1, 50);
    setcookie("secreto", $secreto, time() + 3600);
    $intentos = 5;
    setcookie("intentos", $intentos, time() + 3600);
    $_SESSION['historico_intentos'] = []; // Inicializa el histórico de intentos

    // Si la cookie no existía, redirigimos para que se cargue en la siguiente petición.
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: adivinaNumeroNew.php');
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numero'])) {

    // Guardar el mensaje en la sesión para que sobreviva a la redirección
    $numero = (int) $_POST['numero'];
    $intentos = (int) $_COOKIE["intentos"]; // Usamos el valor original de intentos

    // Lógica principal
    if ($numero === $secreto) {
        $_SESSION['mensaje'] = "Felicidades! Has adivinado el número: " . $numero;
        reiniciar_juego(); // El juego se reinicia y se redirige
    } else {

        $_SESSION['historico_intentos'][] = $numero; // Guardar intento en el histórico
        $intentos--;
        setcookie("intentos", $intentos, time() + 3600); // Actualiza la cookie de intentos

        if ($numero < $secreto) {
            $pista = "El número es mayor que: " . $numero;
        } else {
            $pista = "El número es menor que: " . $numero;
        }

        if ($intentos <= 0) {
            $_SESSION['mensaje'] = "Fin del juego! No te quedan más intentos. El número era: " . $secreto;
            reiniciar_juego(); // El juego se reinicia y se redirige
        } else {
            $_SESSION['mensaje'] = $pista . " | Intentos restantes: " . $intentos;
        }
    }

    header('Location: adivinaNumeroNew.php');
    exit();
}

// 3. Mostrar Mensajes de la Sesión (Solo si no estamos en POST)
$mensaje = $_SESSION['mensaje'] ?? "¡Intenta adivinar el número!";
unset($_SESSION['mensaje']); // Limpiar el mensaje después de mostrarlo
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adivina el número</title>
</head>

<body>
    <h1>Adivina el número entre 1 y 50</h1>
    <?php if (isset($_SESSION['historico_intentos'])): ?>
        <p>Histórico de intentos:
            <?php
            // Convierte el array en una cadena, separando cada elemento con ", "
            echo implode(', ', $_SESSION['historico_intentos']);
            ?>
        <?php endif; ?>
        <p>Número de intentos restantes: <?= $intentos ?></p>
        <form method="POST" action="adivinaNumeroNew.php">
            <label for="numero">Introduce tu número:</label>
            <input type="number" id="numero" name="numero" min="1" max="50" required>
            <button type="submit">Adivinar</button>
        </form>

        <?php if (isset($mensaje)): ?>
            <p><?= $mensaje ?></p>
        <?php endif; ?>

</body>

</html>