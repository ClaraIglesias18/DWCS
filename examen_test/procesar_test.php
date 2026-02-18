<?php
session_start();
require_once 'db.php';
require_once 'funciones_preguntas.php';
require_once 'funciones_resultados.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_test = $_POST['id_test'];
    $id_usuario = $_SESSION['id_usuario'];
    $respuestas_usuario = $_POST['respuestas']; // Es un array [id_pregunta => 'a']


    // 1. Traemos las preguntas (con la respuesta correcta) para comparar
    $preguntas_correctas = obtener_preguntas_correctas($conexion, $id_test);
    
    $aciertos = 0;
    $total_preguntas = count($preguntas_correctas);

    // 2. Lógica de corrección
    foreach ($preguntas_correctas as $pregunta) {
        $id_pregunta = $pregunta['id_pregunta'];

        // Si el usuario respondió a esta pregunta y coincide con la solución
        if ($respuestas_usuario[$id_pregunta] === $pregunta['correcta']) {
            $aciertos++;
        }
    }

    // 3. Guardar el resultado usando tu función encapsulada
    // (id_usuario, id_test, aciertos, total)
    guardar_resultado($conexion, $id_usuario, $id_test, $aciertos, $total_preguntas);

    // 4. Redirigir o mostrar feedback
    header("Location: panel.php");
    exit();

}