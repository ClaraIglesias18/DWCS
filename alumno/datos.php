<?php
    function datosAlumno(Alumno $alumno) {
        ob_start();
    ?>
    <div>
    <strong>Nombre: </strong><?=$alumno->getNombre()?> 
    </div>
    <div>
        <strong>Apellidos: </strong><?=$alumno->getApellidos()?> 
    </div>
    <div>
        <strong>Sexo: </strong><?=$alumno->getSexo()?> 
    </div>
    <div>
        <strong>NIF: </strong><?=$alumno->getNif()?> 
    </div>
    <?php
        $texto = ob_get_contents();
        ob_end_clean();
        return $texto;
    }?>