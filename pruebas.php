<?php
include("./class/class.Usuario.php");
include("./class/class.Paciente.php");
include("./class/class.Medico.php");
include("./class/class.Enfermero.php");

//Probamos todos los metodos solicitados de la clase Medico
echo "Clase Medico <br>";
$medico = new Medico(5);

// getCentroSanitario(): Devuelve el centro sanitario en el que trabaja el médico.
$medicoCentro = $medico->getCentroSanitario();
echo ("Centro Sanitario = " . $medicoCentro. "<br>");

// getCupo(): Devuelve el cupo en el que trabaja el médico.
$medicoCupo = $medico->getCupo();
echo ("Cupo = " .$medicoCupo. "<br>");

// getEnfermero(): Devuelve el id del enfermero que trabaja en su cupo.
$medicoEnfermero = $medico->getEnfermero();
echo ("Enfermero asignado = " .$medicoEnfermero. "<br>");

// esMiPaciente(id): Comprueba si el usuario con código id es paciente suyo o no. Devuelve true o false.
echo json_encode ($medico->esMiPaciente(25));
echo "<br>";

// esMiEnfermero(id): Comprueba si el usuario con código id es enfermero de su cupo. Devuelve true o false.
echo json_encode ($medico->esMiEnfermero(15));
echo "<br>";
echo "<hr>";


//Probamos todos los metodos solicitados de la clase Enfermero
echo "Clase Enfermero <br>";

$enfermero = new Enfermero(15);

// esMiPaciente(id): Comprueba si el usuario con código id es paciente suyo o no.
echo json_encode ($enfermero->esMiPaciente(25));
echo "<br>";

// esMiMedico(id): Comprueba si el usuario con código id es médico de su mismo cupo.
echo json_encode ($enfermero->esMiMedico(8));
echo "<br>";

// getCentroSanitario(): Devuelve el centro sanitario en el que trabaja el enfermero.
$enfermeroCentro = $enfermero->getCentroSanitario();
echo ("Centro Sanitario = " . $enfermeroCentro. "<br>");

// getMedico(): Devuelve el id del médico que trabaja en su cupo.
$medicoEnfermero = $enfermero->getMedico();
echo ("Medico asignado = " .$medicoEnfermero. "<br>");

// getCupo(): Devuelve el cupo en el que trabaja el enfermero.
$enfermeroCupo = $enfermero->getCupo();
echo ("Cupo = " .$enfermeroCupo. "<br>");
echo "<hr>";


//Probamos todos los metodos solicitados de la clase Paciente
$paciente = new Paciente(25);

// getCentroSanitario(): Devuelve el centro sanitario vinculado al paciente.
$pacienteCentro = $paciente->getCentroSanitario();
echo ("Centro Sanitario = " . $pacienteCentro. "<br>");

// getCupo(): Devuelve el cupo al que pertenece el paciente.
$pacienteCupo = $paciente->getCupo();
echo ("Cupo = " .$pacienteCupo. "<br>");

// getMedico(): Devuelve el id del médico que atiende al paciente.
$medicoPaciente = $paciente->getMedico();
echo ("Medico asignado = " .$medicoPaciente. "<br>");

// getEnfermero(): Devuelve el id del enfermero que atiende al paciente.
$pacienteEnfermero = $paciente->getEnfermero();
echo ("Enfermero asignado = " .$pacienteEnfermero. "<br>");
echo "<hr>";

?>