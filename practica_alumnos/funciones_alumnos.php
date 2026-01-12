<?php
function obtener_alumnos($conexion) {
    $sql = "SELECT * FROM alumnos";

    $resultado = mysqli_query($conexion, $sql);
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    
}

function insertar_alumno($conexion, $nombre, $apellidos, $correo, $curso) {

    $sql = "INSERT INTO alumnos (nombre, apellidos, correo, curso) VALUES ('$nombre', '$apellidos', '$correo', '$curso')";

    $resultado = mysqli_query($conexion, $sql );

    return $resultado;

}

function eliminar_alumno($conexion, $id_alumno) {

    $sql = "DELETE FROM alumnos WHERE id_alumno = $id_alumno";

    $resultado = mysqli_query($conexion, $sql);

    return $resultado;

}

function obtener_alumno_por_id($conexion, $id_alumno) {

    $sql = "SELECT * FROM alumnos WHERE id_alumno = $id_alumno";

    $resultado = mysqli_query($conexion, $sql);

    $alumno = mysqli_fetch_assoc($resultado);

    return $alumno;

}

function actualizar_alumno($conexion, $id_alumno, $nombre, $apellidos, $correo, $curso) {

    $sql = "UPDATE alumnos SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', curso = '$curso' WHERE id_alumno = $id_alumno";

    $resultado = mysqli_query($conexion, $sql);

    return $resultado;

}