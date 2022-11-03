<?php
session_start();
$color = "#FFF";
$cont = 0;
if (!isset($_SESSION['contador'])) {
    $_SESSION['contador'] = $cont;
} else {
    $cont = $_SESSION['contador'];
}
if (!isset($_SESSION['colorFondo'])) {
    $_SESSION['colorFondo'] = $color;
} else {
    $color = $_SESSION['colorFondo'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['colorFondo'])) {
        $color = $_POST['color'];
        if($_SESSION['colorFondo'] != $color) {
            $cont++;
        }
        $_SESSION['colorFondo'] = $color; 
        $_SESSION['contador'] = $cont;   
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color Fondo</title>
    <style>
        body {
            background-color: <?=$color ?>;
        }
    </style>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input name="color" type="color" id="color">
    <input type="submit" value="Guardar">
    <p>Numero de cambios de color: <?=$cont ?></p>
</form>
</body>
</html>