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
<script>$("#menu-citas").addClass('active')</script>


<section class="mt-3">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h3>Citas</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table
                        data-toggle="table"
                        data-url="<?php echo $GLOBALES['rutaPrincipal'] ;?>/api/datosJSON.php?tarea=getCitas"
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
                            <th data-sortable="true" data-field="idPaciente">ID Paciente</th>
                            <th data-sortable="true" data-field="tipo">Tipo</th> 
                            <th data-field="fechaHora">Fecha y hora </th>
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
            //Crear Cita en DB
            window.location.href = "<?php echo $GLOBALES['rutaPrincipal'] ;?>/citas/formCitas.php?id="+row.id;
        },
		'click .borrarCita': function (e, value, row, index) {
            //Borrar Cita en DB
            window.location.href = "<?php echo $GLOBALES['rutaPrincipal'] ;?>/usuarios/formUsuario.php?id="+row.id;
        }
    }

    function operateFormatter(value, row, index) {
        return [
            '<div class="text-center">',
            '<a class="verFichaUsuario" href="javascript:void(0)" title="Nueva Cita">',
            '<i class="fas fa-plus-circle"></i>',
            '</a>  ',
			'<a class="borrarCita" href="javascript:void(0)" title="Borrar Cita">',
            '<i class="fas fa-trash-alt"></i>',
            '</a>  ',
            '</div>'
        ].join('')
    }
</script>

</html>