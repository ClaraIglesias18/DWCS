<?php
    include("funcionesbd1.php");

    $conexion=conectarNovaBD();

    if(!$conexion){
        mostrarerror("ó conectar: ");
    }
    else{
        $consulta = "SELECT * FROM alumnos";
        $alumnos=consultarBD($conexion,$consulta);
    }
?>
<!DOCTYPE html>
<html lang="es">

    <head>
    <meta charset="utf-8">
        <title>Tabla</title>
        <style>
            .borde{
                border: 2px solid black;
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>
        <table class="border">
            <tr>
                <td class='borde'>Nome</td>
                <td class='borde'>Primer apelido</td>
                <td class='borde'>Segundo apelido</td>
                <td class='borde'>Email</td>
                <td class='borde'></td>
            </tr>

            <?php
                while($filalumno = mysqli_fetch_array($alumnos)) {
                    echo "<tr><td class='borde'>".$filalumno['nome']."</td>";
                    echo "<td class='borde'>".$filalumno['apelido1']."</td>";
                    echo "<td class='borde'>".$filalumno['apelido2']."</td>";
                    echo "<td class='borde'>".$filalumno['email']."</td>";
                    echo "<td class='borde'><a href='procesarbd1.php?id=".$filalumno['id']."'>Eliminar</a></td>";
                    echo "<td class='borde'><a href='procesarbd1.php?mod=".$filalumno['id']."'>Actualizar</a></td></tr>";
                }
                mysqli_close($conexion);

                //Hizo un php llamado actualizar
            ?>
        </table>
        <a href="formulariobd1.php">Volver al formulario</a>
    </body>