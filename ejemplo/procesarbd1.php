<?php
include("funcionesbd1.php");

$conexion=conectarNovaBD();

if(!$conexion){
    mostrarerror("ó conectar: ");
}
else{
    if(isset($_POST["nome"])){
        $nome=$_POST['nome'];
        $apelido1=$_POST['apelido1'];
        $apelido2=$_POST['apelido2'];
        $email=$_POST['email'];
        $consulta="INSERT INTO alumnos (nome,apelido1,apelido2,email) VALUES ('$nome','$apelido1','$apelido2','$email')";
        if(consultarBD($conexion, $consulta)){
            header("location: mostrarbd1.php");
        }else{
            mostrarerror("ó insertar: ");
        }
    }
    if(isset($_GET["id"])){
        $id_borrar=$_GET['id'];
        $borrar="DELETE FROM alumnos WHERE id='$id_borrar'";
        consultarBD($conexion,$borrar);
        echo "Se ha borrado al alumno ".$id_borrar;
    }
    if(isset($_GET['mod'])){
        $modificar=$_GET['mod'];
        $mod="SELECT * FROM alumnos WHERE id='$modificar'";
        $alumnos=consultarBD($conexion,$mod);
        $alumno=mysqli_fetch_array($alumnos);
        echo $alumno['nome'];

    }
}

?>