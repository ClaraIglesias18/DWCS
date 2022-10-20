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
    <h1>Formulario Alumno</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"method="post">
        <input name="nombre" type="text">
        <input name="apellidos" type="text">
        <input name="sexo" type="radio" value="Hombre">
        <label for="hombre">Hombre</label>
        <input name="sexo" type="radio" value="Mujer">
        <label for="mujer">Mujer</label>
        <input name="sexo" type="radio" value="Otro">
        <label for="otro">Otro</label>
        <input name="nif" type="text">
        <input type="submit" name="enviar">
    </form>
</body>

</html>