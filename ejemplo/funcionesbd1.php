<?php

    // se hacen funciones para llamar proceduralmente a mysqli en vez de usar objetos
    // mysql query para realizar las consultas ya sean de insercion o seleccion,
    // nos creamos aparte las consultas en un archivo de funciones


    //Función para conectar a la base de datos
    function conectarBD(){
        return @mysqli_connect('localhost', 'root', 'abc123.', null ,"3306");
    }

    function conectarNovaBD(){
        return @mysqli_connect('localhost','root',"abc123.","novaBD",'3306');
    }

    //Función para llamar y mostrar una línea de error
    function mostrarerror($accion){
        echo('Erro nº ' . mysqli_connect_errno() . $accion . mysqli_connect_error());
    }

    //Función para consultar en la base de datos
    function consultarBD($conexion, $consulta){
        return mysqli_query($conexion, $consulta);
    }

    //Función para seleccionar la base de datos
    function seleccionarBD($conexion, $nome){
        return mysqli_select_db($conexion, $nome);
    }