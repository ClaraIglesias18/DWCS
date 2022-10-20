<h1>Formulario Alumno</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="nombre">Nombre: </label>
    <input name="nombre" type="text">
    <label for="apellidos">Apellidos: </label>
    <input name="apellidos" type="text">
    <input name="sexo" type="radio" value="Hombre">
    <label for="hombre">Hombre</label>
    <input name="sexo" type="radio" value="Mujer">
    <label for="mujer">Mujer</label>
    <input name="sexo" type="radio" value="Otro">
    <label for="otro">Otro</label>
    <label for="nif">NIF: </label>
    <input name="nif" type="text">
    <input type="submit" value="Enviar">
</form>