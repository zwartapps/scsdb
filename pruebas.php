<?php
include("./class/class.Usuario.php");
include("./class/class.Paciente.php");
include("./class/class.Medico.php");
include("./class/class.Enfermero.php");


$paciente = new Paciente(25);

print_r($paciente);


?>