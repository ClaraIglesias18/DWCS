<?php
    $dsn = "mysql:dbname=usuario;host=docker-mysql";
    $usuario = "root";
    $password = "root123";
    try {
        $bd = new PDO($dsn, $usuario, $password);        
        $sql = "select * from usuario";
        $datos = $bd->query($sql);
        echo "Total usuarios: " . $datos->rowCount() . "<br>";
        foreach($datos as $usu) {
            echo $usu["nombre"]." " . $usu["apellidos"] . "<br>";
        }

        echo "-----------------------<br>";
        $stm = $bd->prepare("select * from usuario where idUsuario = ?");
        $stm->execute([1]);

        foreach($stm as $datos) {
            echo $datos["nombre"];
        }
    } catch (Exception $e) {
        echo "ERROR: ". $e->getMessage();
    }
    
?>