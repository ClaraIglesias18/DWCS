<!DOCTYPE html>
<html lang="es">

    <head>
    <meta charset="utf-8">
        <title>Formulario</title>
        <style>
            .rojo{
                color: red;
            }
        </style>
    </head>
    <body>
        <form action="procesarbd1.php" method="POST">
            <label for="nome"> Nombre </label>
            <input id="nome" type="text" name="nome" required/>
            <br/>
            <br />
            <label for="edad"> Primer apellido </label>
            <input id="apelido1" type="text" name="apelido1"required/>
            <br/>
            <br/>
            <label for="email"> Segundo apellido </label>
            <input id="apelido2" type="text" name="apelido2"required/>
            <br/>
            <br/>
            <label for="email"> Email </label>
            <input id="email" type="email" name="email"required/>
            <br/>
            <br/>
            <input type="submit" value="Enviar"/><br />
        </form>
        </br>
        <a href="mostrarbd1.php">Tabla</a>
    </body>
</html>