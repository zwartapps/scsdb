<?php
include("../globales.php");
include("../acceso/cargarSesion.php");
include("../acceso/comprobarLogIn.php");
include("../class/class.Usuario.php");
include("../class/class.Rol.php");
include("../class/class.PermisosWeb.php");

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

<!-- Activamos la sección del menú -->
<script>$("#menu-enfermeros").addClass('active')</script>

<section class="mt-3">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h3>Enfermeros</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table
                        data-toggle="table"
                        data-url="<?php echo $GLOBALES['rutaPrincipal'] ;?>/api/datosJSON.php?tarea=getUsersForTable&getRol=3"
                        data-locale="es-SP"
                        class="table-striped"
                        data-pagination="true"
                        data-unique-id="id"
                        data-show-refresh="true"
                        data-show-toggle="true"
                        data-show-columns="true"
                        data-side-pagination="server"
                        data-page-size="10"
                        data-page-list="[5, 10, 20, 50, 100, 200]"
                        data-search="true">
                    <thead class="bg-warning">
                        <tr>
                            <th data-sortable="true" data-field="id">ID</th>
                            <th data-sortable="true" data-field="nombre">Nombre</th>
                            <th data-sortable="true" data-field="apellidos">Apellidos</th>
                            <th data-field="email">Email</th>
                            <th data-sortable="true" data-field="numColegiado">Nº Colegiado</th>
                            <th data-field="nombreCentroSalud">Centro</th>
                            <th data-field="nombreCupo">Cupo</th>
                            <th data-events="operateEvents" data-formatter="operateFormatter">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <!-- Incluimos el menú de navegación -->
    <?php include("../footer.php"); ?>
</footer>
</body>

<script>
    window.operateEvents = {
        'click .verFichaUsuario': function (e, value, row, index) {
            window.location.href = "<?php echo $GLOBALES['rutaPrincipal'] ;?>/usuarios/fichaUsuario.php?id="+row.id;
        },
		'click .editarUsuario': function (e, value, row, index) {
            window.location.href = "<?php echo $GLOBALES['rutaPrincipal'] ;?>/usuarios/formUsuario.php?id="+row.id;
        }
    }

    function operateFormatter(value, row, index) {
        return [
            '<div class="text-center">',
            '<a class="verFichaUsuario" href="javascript:void(0)" title="Ver ficha">',
            '<i class="fas fa-chevron-circle-right"></i>',
            '</a>  ',
			'<a class="editarUsuario" href="javascript:void(0)" title="Editar usuario">',
            '<i class="fas fa-user-edit"></i>',
            '</a>  ',
            '</div>'
        ].join('')
    }
</script>

</html>