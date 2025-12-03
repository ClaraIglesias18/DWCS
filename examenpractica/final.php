<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        echo "Bienvenido " .  $_SESSION['nombre'];
    ?>
    </br>
    <a href="formulario.php">Ir ao formulario</a>
</body>
</html>