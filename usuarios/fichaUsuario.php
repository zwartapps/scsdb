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

// Cargamos el usuario del que se quiere mostrar su ficha y su rol
$id = $_GET['id'];
$usuarioFicha = new Usuario($id);
$rolUsuarioFicha = new Rol($usuarioFicha->idRol);

// Cargamos la clase correspondiente y preparamos el contenido a partir de la plantilla
$usuarioFicha = new $rolUsuarioFicha->clase($usuarioFicha->id);
$seccionHTML = file_get_contents($rolUsuarioFicha->plantilla);

// Cargamos el centro de Salud
$centroSaludUsuarioFicha = new CentroSalud($usuarioFicha->idCentroSalud);

// Cargamos el cupo
$cupoFicha = new Cupo($usuarioFicha->idCupo);

// Reemplazamos cada atributo del objeto en la plantilla
$busqueda = array();
$reemplazo = array();
foreach ($usuarioFicha->getAtributos() as $atributo => $valor) {
    array_push($busqueda, '{$'.$atributo.'}');
    array_push($reemplazo, $valor);
}

// Reemplazamos también la edad
$seccionHTML = str_replace($busqueda,$reemplazo,$seccionHTML);
$seccionHTML = str_replace('{$edad}',$usuarioFicha->getEdad(),$seccionHTML);
$seccionHTML = str_replace('{$tipo}',$rolUsuarioFicha->nombre,$seccionHTML);
$seccionHTML = str_replace('{$centroSanitario}',$centroSaludUsuarioFicha->nombre,$seccionHTML);
$seccionHTML = str_replace('{$codigoCupo}',$cupoFicha->nombre,$seccionHTML);

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