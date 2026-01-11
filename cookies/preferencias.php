<?php
// 1. LÓGICA DE BORRADO (Si el usuario pulsa "Borrar Ajustes")
if (isset($_POST['borrar'])) {
    setcookie('user_name', '', time() - 3600);
    setcookie('lang', '', time() - 3600);
    setcookie('last_visit', '', time() - 3600);
    header("Location: " . $_SERVER['PHP_SELF']); // Recargar para aplicar cambios
    exit;
}

// 2. PROCESAMIENTO DEL FORMULARIO DE PREFERENCIAS
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar'])) {
    $nombre = $_POST['nombre'] ?? 'Invitado';
    $idioma = $_POST['idioma'] ?? 'es';

    // Guardar cookies por 7 días
    setcookie('user_name', $nombre, time() + (7 * 24 * 60 * 60));
    setcookie('lang', $idioma, time() + (7 * 24 * 60 * 60));
    
    header("Location: " . $_SERVER['PHP_SELF']); // Recargar para ver los cambios
    exit;
}

// 3. OBTENCIÓN DE VALORES ACTUALES
// ver la diferencia de funcionaliad entre el uso de isset() y el operador de fusión null ??
$nombreUsuario = $_COOKIE['user_name'] ?? null;
$idiomaActual = $_COOKIE['lang'] ?? 'es';
$fechaUltimaVisita = $_COOKIE['last_visit'] ?? null;

// 4. ACTUALIZAR COOKIE DE ÚLTIMA VISITA (Siempre al cargar)
$ahora = date("d/m/Y H:i:s");
setcookie('last_visit', $ahora, time() + (365 * 24 * 60 * 60));

// 5. DICCIONARIO DE TRADUCCIÓN
$textos = [
    'es' => [
        'titulo' => "Bienvenido a tu Panel",
        'saludo' => "Hola, " . ($nombreUsuario ?? "visitante"),
        'ultima' => "Tu última visita fue el: " . ($fechaUltimaVisita ?? "¡Es tu primera vez aquí!"),
        'label_nombre' => "Tu nombre:",
        'label_idioma' => "Idioma preferido:",
        'btn_guardar' => "Guardar Preferencias",
        'btn_borrar' => "Borrar Ajustes"
    ],
    'en' => [
        'titulo' => "Welcome to your Panel",
        'saludo' => "Hello, " . ($nombreUsuario ?? "guest"),
        'ultima' => "Your last visit was on: " . ($fechaUltimaVisita ?? "It's your first time here!"),
        'label_nombre' => "Your name:",
        'label_idioma' => "Preferred language:",
        'btn_guardar' => "Save Preferences",
        'btn_borrar' => "Clear Settings"
    ]
];

$t = $textos[$idiomaActual];
?>

<!DOCTYPE html>
<html lang="<?= $idiomaActual ?>">
<head>
    <meta charset="UTF-8">
    <title>Práctica de Cookies</title>
    <style>
        body { font-family: sans-serif; padding: 20px; line-height: 1.6; }
        .card { border: 1px solid #ccc; padding: 20px; border-radius: 8px; max-width: 400px; }
        .info { background: #f4f4f4; padding: 10px; margin-bottom: 20px; border-left: 5px solid #007bff; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; }
        input[type="text"], select { width: 100%; padding: 8px; margin-top: 5px; }
        .btn { padding: 10px 15px; cursor: pointer; border: none; border-radius: 4px; }
        .btn-primary { background: #007bff; color: white; }
        .btn-danger { background: #dc3545; color: white; margin-top: 10px; }
    </style>
</head>
<body>

    <div class="card">
        <h1><?= $t['titulo'] ?></h1>

        <div class="info">
            <p><strong><?= $t['saludo'] ?></strong></p>
            <small><?= $t['ultima'] ?></small>
        </div>

        <form method="post">
            <div class="form-group">
                <label><?= $t['label_nombre'] ?></label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($nombreUsuario ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label><?= $t['label_idioma'] ?></label>
                <select name="idioma">
                    <option value="es" <?= $idiomaActual == 'es' ? 'selected' : '' ?>>Español</option>
                    <option value="en" <?= $idiomaActual == 'en' ? 'selected' : '' ?>>English</option>
                </select>
            </div>

            <button type="submit" name="guardar" class="btn btn-primary"><?= $t['btn_guardar'] ?></button>
        </form>

        <form method="post">
            <button type="submit" name="borrar" class="btn btn-danger"><?= $t['btn_borrar'] ?></button>
        </form>
    </div>

</body>
</html>