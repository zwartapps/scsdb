<?php
include("./globales.php");
include("./acceso/cargarSesion.php");
include("./acceso/comprobarLogIn.php");
include("./class/class.Usuario.php");

// Cargamos el usuario
$usuario = new Usuario($_SESSION['usuario']);
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
<?php include("./menu/menu-notlog.php"); ?>

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

        </div>
    </div>
</section>

<footer class="footer">
    <!-- Incluimos el menú de navegación -->
    <?php include("footer.php"); ?>
</footer>
</body>
</html>