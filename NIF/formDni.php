<?php
    include_once("Nif.php");
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["dni"])) {
            echo "Envio correcto"."<br>"."--------------";
            $nif = new Nif($_POST["dni"]); 
            if(ctype_digit($_POST["dni"])) {
                echo "Creado";
            } else {
                echo "Introdujo NIF en vez de DNI"."<br>";
                $letraEntrada = substr($_POST["dni"], -1);
                if($nif->validarLetra($letraEntrada)) {
                    echo "Letra ".$letraEntrada." correcta";
                } else {
                    echo "Letra ".$letraEntrada." incorrecta";
                    echo "<br>"."La letra correcta es: ".$nif->getLetra();
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Alumno</title>
</head>
<body>
    <h1>Introduce el numero de dni</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"method="post">
        <input name="dni" type="text">
        <input type="submit" name="enviar">
    </form>
</body>

</html>