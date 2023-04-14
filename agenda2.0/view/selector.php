<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bdd'])) {
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

<body class="d-flex justify-content-center align-items-center flex-column">
    <h1 class="text-center bg-warning w-100" >Agenda de eventos</h1>
    <h2>Seleccion de BDD</h2>
    <form action="" method="post" class="d-flex justify-content-center align-items-center flex-column">
        <div>
            <input type="radio" name="bdd" value="0">
            <label for="mysql" class="">MySQL</label>
            <input type="radio" name="bdd" value="1">
            <label for="mongodb" class="">MongoDB</label>
        </div>
        <div>
            <input type="submit" value="Aceptar" class="bg-primary text-white btn-lg">
        </div>
    </form>
</body>

</html>