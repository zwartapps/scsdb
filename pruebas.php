<?php
include("./class/class.Usuario.php");
include("./class/class.Paciente.php");
include("./class/class.Medico.php");
include("./class/class.Enfermero.php");

/*Probamos todos los metodos solicitados
getCentroSanitario(): Devuelve el centro sanitario en el que trabaja el médico.
getCupo(): Devuelve el cupo en el que trabaja el médico.
getEnfermero(): Devuelve el id del enfermero que trabaja en su cupo.
esMiPaciente(id): Comprueba si el usuario con código id es paciente suyo o no. Devuelve true o false.
esMiEnfermero(id): Comprueba si el usuario con código id es enfermero de su cupo. Devuelve true o false.
*/

$medico = new Medico(5);

$medicoCentro = $medico->getCentroSanitario();
print_r("Centro Sanitario = " . $medicoCentro. "<br>");

$medicoCupo = $medico->getCupo();
print_r("Cupo = " .$medicoCupo. "<br>");


$medicoEnfermero = $medico->getEnfermero();
print_r("Enfermero asignado = " .$medicoEnfermero. "<br>");

print_r($medico->esMiPaciente(24));


//print_r($medico);


/*
$paciente = new Paciente(25);

print_r($paciente);
*/

?>