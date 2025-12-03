<?php
    session_start();

    if(isset($_SESSION['error_nombre'])){
        echo "Por favor, escribe un usuario";
        unset($_SESSION['error_nombre']);
    }
    if(isset($_SESSION['error_pass'])){
        echo "Por favor, escribe una contraseña";
        unset($_SESSION['error_pass']);
    }
    if(isset($_SESSION['error_color'])){
        echo "Por favor, escribe un color";
        unset($_SESSION['error_color']);
    }
    if(isset($_SESSION['usuario_mal'])){
        echo "Escribe el usuario correcto";
        unset($_SESSION['usuario_mal']);
    }
    if(isset($_SESSION['pass_len'])){
        echo "Escribe una contraseña de entre 8 y 15 caracteres";
        unset($_SESSION['pass_len']);
    }
    if(isset($_SESSION['pass_num'])){
        echo "Escribe una contraseña con al menos un número";
        unset($_SESSION['pass_num']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="validacions.php" method="POST">
        <label for="nombre">Escribe el usuario</label>
        <input type="text" name="nombre" value="<?php if(isset($_SESSION['nombre'])){
                                                            echo $_SESSION['nombre'];
                                                            unset($_SESSION['nombre']);
                                                        } ?>" />
        </br>
        <label for="pass">Escribe una contraseña</label>
        <input type="password" name="pass" />
        </br>
        <label for="color">Escribe un color</label>
        <input type="text" name="color" value="<?php if(isset($_SESSION['color'])){
                                                        echo $_SESSION['color'];
                                                        unset($_SESSION['color']);
                                                    } ?>" />
        </br>
        <input type="submit" value="Enviar" />
    </form>

</body>
</html>