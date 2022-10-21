<?php
include_once("Alumno.php");
include_once("datos.php");
$salida;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $alumno = new Alumno($_POST['nombre'], $_POST['apellidos'], $_POST['sexo'], $_POST['nif']);
    } catch(Exception $e) {
        unset($alumno);
        $error = $e->getMessage();
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
    <?php
        if(isset($error)) {?>
            <div class="error"><?=$error ?></div>
        <?php }
        if (isset($alumno)) {
            echo datosAlumno($alumno);
        } 
    ?>
    <?php include_once("componentes/formulario.php"); ?>
</body>
</html>