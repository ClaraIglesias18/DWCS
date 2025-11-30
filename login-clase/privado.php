<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION["usuario"])) {
    header("location:login.php");
    exit();
}

echo $hash = password_hash($_SESSION["usuario"]["password"],PASSWORD_DEFAULT);

if (password_verify($_SESSION["usuario"]["password"],$hash)) {
    echo "Acceso verificado";
} else {
    echo "acceso denegado";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <h1>TOP SECRET</h1> 
</body>
</html>