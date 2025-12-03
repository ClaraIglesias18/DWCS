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
    <table style="border:1px solid black">
        <caption>Tabla</caption>
        <tr>
            <?php 
                if(isset($_SESSION['usuario']['nombre'])){
                    foreach($_SESSION['usuario']['nombre'] as $valor){
                        echo "<td style='border:1px solid black'>$valor</td>";
                    }
                }
            ?>
        </tr>
        <tr>
            <?php 
                if(isset($_SESSION['usuario']['color'])){
                    foreach($_SESSION['usuario']['color'] as $valor){
                        echo "<td style='border:1px solid black'>$valor</td>";
                    }
                }
            ?>
        </tr>
    </table>
    </br>

    <a href="formulario.php">Ir ao formulario</a>
    </br>
    <a href="final.php">Ir ao final</a>
</body>
</html>