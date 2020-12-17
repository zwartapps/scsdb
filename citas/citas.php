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
$cita = new Cita();

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
            <div class="col-md-8">
                <a href="formCitas.php" class="btn btn-success" role="button">Nueva Cita</a>
            </div>
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
                        <th data-sortable="true" data-field="idCita">ID Cita</th>                       
                            <th data-field="nombre">Nombre</th>
                            <th data-field="apellidos">Apellidos</th>
                            <th data-field="tipoCita">Tipo</th> 
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
        'click .modificarCita': function (e, value, row, index) {
            //Modificar Cita en DB
            window.location.href = "<?php echo $GLOBALES['rutaPrincipal'] ;?>/citas/formCitas.php?id="+row.idCita;
        },
		'click .borrarCita': function (e, value, row, index) {
            //Borrar Cita en DB                    
          window.location.href = "<?php echo $GLOBALES['rutaPrincipal'] ;?>/citas/eliminarCita.php?id="+row.idCita;
        }
    }

    function operateFormatter(value, row, index) {
        return [
            '<div class="text-center">',            
            '<a class="modificarCita" href="javascript:void(0)" title="Modificar Cita">',
            '<i class="fas fa-edit"></i>',
            '</a>  ',
			'<a class="borrarCita" href="javascript:void(0)" title="Eliminar Cita">',
            '<i class="fas fa-trash-alt" style= "color:red;"></i>',
            '</a>  ',
            '</div>'
        ].join('')
    }
</script>

</html>