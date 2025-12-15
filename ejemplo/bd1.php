<?php
include("funcionesbd1.php");
//Establecemos conexión con el sistema gestor de base de datos (SGBD)
$conexion = conectarBD(); 

//Si hubo error lo muestra
  if (!$conexion) { 
    //El texto sustituye $accion al llamar a la funcion
    mostrarError("ao conectar: "); 
  }
  //Si todo fue OK
  else{
    //Creamos y ejecutamos la consulta de creación
    $crearBD = 'CREATE DATABASE novaBD';
    if (consultarBD($conexion, $crearBD) === TRUE) {
      //Si se creó bien, seleccionamos la base de datos, creamos y ekecutamos la consulta de creación de tabla
      $nome='novaBD';
      //Si se ha creado la base de datos, la seleccionamos y si se selecciona, creamos la tabla
      if(seleccionarBD($conexion, $nome)){
        $crearTabla = 'CREATE TABLE alumnos ( 
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
          nome VARCHAR(30) NOT NULL, 
          apelido1 VARCHAR(30) NOT NULL, 
          apelido2 VARCHAR(30) NOT NULL, 
          email VARCHAR(50) 
        )'; 
        
        //Si funcionó
        if (consultarBD($conexion, $crearTabla)) { 
          echo('Táboa alumnos creada con éxito.');
        }
        //Si falló la creación de la tabla
        else { 
          mostrarError("ao crear a tabla: "); 
        }
      }
      //Si falló el seleccionar la base de datos
      else{
        mostrarError("ao seleccionar a BD: ");
      }
    }
    //Si falló la creación de la tabl
    else { 
      mostrarError("ao crear a BD: ");; 
    }
  }

