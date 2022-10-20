<?php
include_once("Alumno.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['nif']) && isset($_POST['sexo'])) {
        echo "Envio correcto"."<br>"."----------------";
        $alumno = new Alumno($_POST['nombre'], $_POST['apellidos'], $_POST['sexo'], $_POST['nif']);
        echo $alumno;
    } else {
        echo "Envio incorrecto";
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
    <?php include_once("componentes/formulario.php"); ?>
</body>

</html>