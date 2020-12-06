<?php
require_once("./globales.php");
require_once("./acceso/cargarSesion.php");
require_once("./acceso/comprobarLogIn.php");
require_once("./class/class.Usuario.php");
require_once("./class/class.Rol.php");

// Cargamos el usuario
$usuario = new Usuario($GLOBAL_SESSION[CAMPO_DATOS_SESION]['id']);

// Cargamos los datos del Rol
$rol = new Rol($usuario->idRol);

// Comprobamos si puede estar aquí
// Obtenemos el nombre del script
$nombrePaginaActual = basename(__FILE__);

if ($nombrePaginaActual != $rol->indexWeb) {
    // Si queremos, podemos redireccionar a alguna página web
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Pruebas PHP - CIP</title>
    <meta charset="UTF-8">
    <meta name="title" content="Sistema de Pruebas SCS">
    <meta name="description" content="Web con diferentes formularios para hacer pruebas con PHP">
    <?php include("./lib/header.php"); ?>
</head>


<body>
<!-- Incluimos el menú de navegación -->
<?php include("./menu/".$rol->menuWeb); ?>

<!-- Activamos la sección del menú -->
<script>$("#menu-home").addClass('active')</script>


<section class="mt-3">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h3>Bienvenido/a <?php echo $usuario->nombre." ".$usuario->apellidos; ?></h3>
            </div>
        </div>
        <div class="row">
        <div class="col-md-4">
                <div class="card bg-light border-warning mb-3" style="max-width: 18rem;">
                    <div class="card-header text-secondary font-weight-bold">Médicos</div>
                    <div class="card-body">
                        <h3 class="card-title text-center text-warning"><i class="fas fa-user-md fa-3x"></i></h3>
                        <p class="card-text text-info text-justify"></p>
                    </div>
                    <div class="card-footer text-center"><a href="./usuarios/medicos.php" type="button" class="btn border-secondary btn-warning"><i class="fas fa-arrow-circle-right"></i></a></div>
                </div>
            </div>         
            <div class="col-md-4">
                <div class="card bg-light border-warning mb-3" style="max-width: 18rem;">
                    <div class="card-header text-secondary font-weight-bold">Citas</div>
                    <div class="card-body">
                        <h3 class="card-title text-center text-warning"><i class="fas fa-calendar-alt fa-3x"></i></h3>
                        <p class="card-text text-info text-justify"></p>
                    </div>
                    <div class="card-footer text-center"><a href="./citas/citas.php" type="button" class="btn border-secondary btn-warning"><i class="fas fa-arrow-circle-right"></i></a></div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <!-- Incluimos el menú de navegación -->
    <?php include("footer.php"); ?>
</footer>
</body>
</html>