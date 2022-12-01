<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de correo</title>
</head>
<body>
    <form action="pruebaCorreo.php" method="post">
        <labebl for="origen">De: </labebl>
        <input type="text" name="origen">
        <br>
        <label for="asunto">Asunto: </label>
        <input type="text" name="asunto">
        <br>
        <label for="cuerpo">Cuerpo: </label>
        <br>
        <textarea rows="5" cols="10" name="cuerpo"></textarea>
        <br>
        <input type="submit" name="Enviar">
    </form>

    
</body>
</html>