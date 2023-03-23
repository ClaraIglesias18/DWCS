<?php
session_start();
    if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['bdd'])) {
        $bdd = $_POST['bdd'];
        $_SESSION['bdd'] = $bdd;
        header("location:login.php");
        exit();

    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Selector de BDD</title>
</head>

<body>
    <h1>Seleccion de BDD</h1>
    <form action="" method="post">
        <input type="radio" name="bdd" value="0">
        <label for="mysql">MySQL</label>
        <input type="radio" name="bdd" value="1">
        <label for="mongodb">MongoDB</label>
        <input type="submit" value="Aceptar">
    </form>
</body>

</html>