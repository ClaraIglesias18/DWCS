<?php
$color = "#FFF";
$cont = 0;
if (!isset($_COOKIE['contador'])) {
    setcookie('contador', $cont, time() + 3600);
} else {
    $cont = $_COOKIE['contador'];
}
if (!isset($_COOKIE['colorFondo'])) {
    setcookie('colorFondo', $color, time() + 3600);
} else {
    $color = $_COOKIE['colorFondo'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE['colorFondo'])) {
        $color = $_POST['color'];
        setcookie('colorFondo', $color, time() + 3600);
        if($_COOKIE['colorFondo'] != $color) {
            $cont++;
        } 
        setcookie('contador', $cont, time() + 3600);   
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