<?php

require_once("../globales.php");
require_once("../acceso/cargarSesion.php");
require_once("../acceso/comprobarLogIn.php");
require_once("../class/class.Usuario.php");
require_once("../class/class.Medico.php");
require_once("../class/class.Rol.php");
require_once("../class/class.Cupo.php");
require_once("../class/class.PermisosWeb.php");
require_once("../class/class.CentroSalud.php");
require_once("../class/class.Paciente.php");
require_once("../class/class.Cita.php");

// Cargamos el usuario
$usuario = new Usuario($GLOBAL_SESSION[CAMPO_DATOS_SESION]['id']);

// Cargamos los datos del Rol
$rolUsuario = new Rol($usuario->idRol);

// Comprobamos si puede estar aquí
$nombrePaginaActual = basename(__FILE__);
$permisosWeb = new PermisosWeb($usuario->idRol, $nombrePaginaActual);

if (!$permisosWeb->permitido) {
    exit;
}



/***************Cambiar todo de paciente a CITA****************/





// Comprobamos si se ha cargado el formulario y hay que guardar los datos
if (isset($_GET['guardar'])) {
    if ($_GET['id'] != 0) {
        // PAciente ya existente -> Hay que modificar
        $pacienteGuardar = new Paciente($_GET['id']);
    } else {
        $pacienteGuardar = new Paciente();
        $pacienteGuardar->idRol = 4;
        $pacienteGuardar->numIntentosLogin = 0;
        $pacienteGuardar->ultimoAcceso = date("Y-m-d H:i:s");
    }

    foreach($_POST as $clave => $valor) {
        if ($clave != 'password') {
            $pacienteGuardar->$clave = $valor;
        } else {
            if ($valor != '') {
                // Actualizamos la contraseña
                $pacienteGuardar->setPassword($valor);
            }
        }
    }

    if ($pacienteGuardar->guardar()) {
        $mensajeGuardado = 'SE HA CREADO/ACTUALIZADO EL USUARIO';
    } else {
        $mensajeGuardado = 'HA OCURRIDO UN ERROR AL INTENTAR GUARDAR/CREAR EL USUARIO';
    }
    $id = $pacienteGuardar->id;
}

// Primero comprobamos si se trata de la edición de un usuario existente
if (isset($_GET['id'])) {
    // Cargamos los datos del usuario existente
    $id = $_GET['id'];
    $paciente = new Paciente($id);
} else {
    $id = 0;
    $paciente = new Paciente();
    $paciente->idRol = 4;
}

if (isset($pacienteGuardar)) {
    $id = $pacienteGuardar->id;
    $paciente = $pacienteGuardar;
}

$rolPaciente = new Rol($paciente->idRol);

// Cargamos los roles
$roles = cargarRoles('FETCH_OBJ');
$htmlRoles = "";
foreach($roles as $rol) {
	if ($rol->id == $paciente->idRol) {
		$htmlRoles .= "<option value='{$rol->id}' selected>{$rol->nombre}</option>";
	} else {
		$htmlRoles .= "<option value='{$rol->id}'>{$rol->nombre}</option>";
	}
}

// Preparamos el select para ver si está bloqueado o no
$htmlBloqueado = "";
if ($paciente->bloqueado) {
    $htmlBloqueado .= "<option selected value='1'>SÍ</option>";
    $htmlBloqueado .= "<option value='0'>NO</option>";
} else {
    $htmlBloqueado .= "<option value='1'>SÍ</option>";
    $htmlBloqueado .= "<option selected value='0'>NO</option>";
}

// Cargamos los tipos de Cita
$citas = cargarCitas('FETCH_OBJ');
$htmlCitas = "";
foreach($citas as $cita) {
	if ($cita->id == $paciente->idCupo) {
		$htmlCupos .= "<option value='{$cita->id}' selected>{$cupo->nombre}</option>";
	} else {
		$htmlCupos .= "<option value='{$cita->id}'>{$cupo->nombre}</option>";
	}

}

// Cargamos los cupos
$cupos = cargarCupos('FETCH_OBJ');
$htmlCupos = "";
foreach($cupos as $cupo) {
	if ($cupo->id == $paciente->idCupo) {
		$htmlCupos .= "<option value='{$cupo->id}' selected>{$cupo->nombre}</option>";
	} else {
		$htmlCupos .= "<option value='{$cupo->id}'>{$cupo->nombre}</option>";
	}
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
<?php include("../menu/".$rolUsuario->menuWeb); ?>

<div class="container">
    <div class="row mt-4">
        <h3>Crear una Cita</h3>
        <div class="col-md-12 mt-4">
            <form action="formPaciente.php?guardar=1&id=<?php echo $id; ?>" method="POST">
                <!-- Campo oculto con el id a modificar -->
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <!-- Campos nombre y apellidos -->
                <div class="row">
                    <div class="col-md-3">
                        <label class="sr-only" for="inlineFormInputGroup">Nombre</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Nombre</div>
                            </div>
                            <input name="nombre" type="text" class="form-control" id="inlineFormInputGroup" placeholder="Nombre" value="<?php echo $paciente->nombre; ?>">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label class="sr-only" for="inlineFormInputGroup">Apellidos</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Apellidos</div>
                            </div>
                            <input name="apellidos" type="text" class="form-control" id="inlineFormInputGroup" placeholder="Apellidos" value="<?php echo $paciente->apellidos; ?>">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label class="sr-only" for="inlineFormInputGroup">Email</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Email</div>
                            </div>
                            <input name="email" type="email" class="form-control" id="inlineFormInputGroup" placeholder="Correo electrónico" value="<?php echo $paciente->email; ?>">
                        </div>
                    </div>
                </div>         
                
                <hr>
				
				<!-- Campos centro de salud y cupo -->
                <div class="row">
                    <div class="col-md-4">
                        <label class="sr-only" for="inlineFormInputGroup">Tipo Cita</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Tipo Cita</div>
                            </div>
                            <select name="tipo">
								<?php echo $htmlCitas; ?>
							</select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="sr-only" for="inlineFormInputGroup">Cupo</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Cupo</div>
                            </div>
                            <select name="idCupo">
								<?php echo $htmlCupos; ?>
							</select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="sr-only" for="inlineFormInputGroup">Nº Historial</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Nº Historial</div>
                            </div>
                            <input name="numHistoria" type="text" class="form-control" id="inlineFormInputGroup" placeholder="Nº Historial" value="<?php echo $paciente->numHistoria; ?>">
                        </div>
                    </div>

                </div>
                    <div class="col-md-4">
                        <label class="sr-only" for="inlineFormInputGroup">Fecha y Hora</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Fecha y Hora</div>
                            </div>
                            <input name="fechaHora" type="datetime-local" class="form-control" id="inlineFormInputGroup" placeholder="Fecha y Hora" value="<?php echo $citas->fechaHora; ?>">
                        </div>
                    </div>

   
                </div>				
				<div class="text-right">
					<button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
					<button type="submit" class="btn btn-success">Guardar</button>
				</div>
            </form>
        </div>
    </div>
</div>


<footer class="footer">
    <!-- Incluimos el menú de navegación -->
    <?php include("../footer.php"); ?>
</footer>
</body>

</html>