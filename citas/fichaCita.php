<?php

require_once("../globales.php");
require_once("../acceso/cargarSesion.php");
require_once("../acceso/comprobarLogIn.php");
require_once("../class/class.Usuario.php");
require_once("../class/class.Medico.php");
require_once("../class/class.Cupo.php");
require_once("../class/class.Enfermero.php");
require_once("../class/class.Rol.php");
require_once("../class/class.PermisosWeb.php");
require_once("../class/class.CentroSalud.php");
require_once("../class/class.Paciente.php");
require_once("../class/class.Cita.php");

// Cargamos el usuario
$usuario = new Usuario($GLOBAL_SESSION[CAMPO_DATOS_SESION]['id']);

// Cargamos los datos del Rol
$rol = new Rol($usuario->idRol);

// Comprobamos si puede estar aquí
$nombrePaginaActual = basename(__FILE__);
$permisosWeb = new PermisosWeb($usuario->idRol, $nombrePaginaActual);

if (!$permisosWeb->permitido) {
    exit;
}

// Cargamos la cita del que se quiere mostrar su ficha y el paciente en concreto para mostrar el nº historial
$id = $_GET['id'];
$idPaciente = $_GET['idPaciente'];
$usuarioFicha = new Usuario($idPaciente);
$rolUsuarioFicha = new Rol($usuarioFicha->idRol);

$paciente = new Paciente($idPaciente);
$citaFicha = new Cita($id);

$usuarioFicha = new $rolUsuarioFicha->clase($usuarioFicha->id);
$seccionHTML = file_get_contents($rolUsuarioFicha->plantilla);

//Cargamos los datos de la cita
$fechaHora = new Cita($citaFicha->fechaHora);
$tipo = new Cita($citaFicha->tipo);

// Cargamos el centro de Salud
$centroSaludUsuarioFicha = new CentroSalud($usuarioFicha->idCentroSalud);

//Cargamos los datos de la cita
$fechaHora = new Cita($citaFicha->fechaHora);

// Cargamos el cupo
$cupoFicha = new Cupo($usuarioFicha->idCupo);


//Cargamos nombre sanitario que toca para este paciente dependiendo del tipo de la cita
$enfermeroCita = new Enfermero();
$medicoCita = new Medico();

$medicoCupo = $medicoCita->getCupo();
$enfermeroCupo = $enfermeroCita->getCupo();

if(true){
 // print_r("SOY TU MEDICO!");
  print_r($medicoCupo);
  print_r($enfermeroCupo);
  print_r($cupoFicha);
}




// Reemplazamos cada atributo del objeto en la plantilla
$busqueda = array();
$reemplazo = array();
foreach ($citaFicha->getAtributos() as $atributo => $valor) {
    array_push($busqueda, '{$'.$atributo.'}');
    array_push($reemplazo, $valor);
}

//Cargamos la plantilla con la informacion requerida
$seccionHTML = str_replace('{$fechaHora}', $citaFicha->fechaHora, $seccionHTML);
$seccionHTML = str_replace('{$tipo}',$citaFicha->tipo,$seccionHTML);
$seccionHTML = str_replace('{$centroSanitario}',$centroSaludUsuarioFicha->nombre,$seccionHTML);
$seccionHTML = str_replace('{$codigoCupo}',$cupoFicha->nombre,$seccionHTML);
$seccionHTML = str_replace('{$numHistoria}',$paciente->numHistoria,$seccionHTML);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Pruebas PHP - CIP</title>
    <meta charset="UTF-8">
    <meta name="title" content="Sistema de Pruebas SCS">
    <meta name="description" content="Web con diferentes formularios para hacer pruebas con PHP">
    <?php include("../lib/header.php"); ?>
</head>


<body>
<!-- Incluimos el menú de navegación -->
<?php include("../menu/".$rol->menuWeb); ?>

<?php echo $seccionHTML; ?>


<footer class="footer">
    <!-- Incluimos el menú de navegación -->
    <?php include("../footer.php"); ?>
</footer>
</body>

</html>