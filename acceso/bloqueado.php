<?php
require_once("cargarSesion.php");
require_once("../globales.php");

if (isset($_SESSION['nombreUsuario'])) {
    header('Location: '.$GLOBALES["rutaPrincipal"].'/index.php');
    exit;
} else {
    $menuACargar = "../menu/menu-notlog.php";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Pruebas PHP - CIP</title>
    <meta charset="UTF-8">
    <meta name="title" content="Prueba de formularios PHP">
    <meta name="description" content="Web con diferentes formularios para hacer pruebas con PHP">
    <?php include("../lib/header.php"); ?>
</head>

<body>
<!-- Incluimos el menú de navegación -->
<?php include($menuACargar); ?>

<!-- Activamos la sección del menú -->
<script>$("#menu-home").addClass('active')</script>

<div class="container text-center">
        <h2>Usuario Bloqueado</h2>
       <h3>Contacta con su administrador</h3>
        <button class="btn btn-danger" type="button" onclick="window.history.back();">Volver al Login</button>
    </div>


<footer class="footer">
    <!-- Incluimos el menú de navegación -->
    <?php include("../footer.php"); ?>
</footer>
</body>
</html>