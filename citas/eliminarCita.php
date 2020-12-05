<?php
include("../globales.php");
include("../acceso/cargarSesion.php");
include("../acceso/comprobarLogIn.php");
include("../class/class.Usuario.php");
include("../class/class.Rol.php");
include("../class/class.PermisosWeb.php");
include("../class/class.Cita.php");

// Cargamos el usuario
$usuario = new Usuario($GLOBAL_SESSION[CAMPO_DATOS_SESION]['id']);

//Cargamos los datos de Citas
$id;

// Cargamos los datos del Rol
$rol = new Rol($usuario->idRol);

// Comprobamos si puede estar aquí
$nombrePaginaActual = basename(__FILE__);
$permisosWeb = new PermisosWeb($usuario->idRol, $nombrePaginaActual);

if (!$permisosWeb->permitido) {
    exit;
}

if (isset($_GET['borrar'])) {
    $citaBorrar = new Cita($_GET['id']);
    $citaBorrar->eliminar();
    header('Location: citas.php');
}
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
    <?php include("../menu/" . $rol->menuWeb); ?>

    <!-- Activamos la sección del menú -->
    <script>
        $("#menu-citas").addClass('active')
    </script>

    <div class="container">
        <h2>Está seguro que quiere eliminar esta cita?</h2>
        <a href="eliminarCita.php?borrar=1&id=<?php echo $_GET['id']; ?>" class="btn btn-success" type="button" name="confirmar" id="confirmar">Eliminar</a>
        <button class="btn btn-danger" type="button" onclick="window.history.back();">Cancelar</button>
    </div>

    <footer class="footer">
        <!-- Incluimos el menú de navegación -->
        <?php include("../footer.php"); ?>
    </footer>
</body>

</html>