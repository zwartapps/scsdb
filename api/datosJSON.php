<?php
require_once(__DIR__."/../globales.php");
require_once(__DIR__."/../acceso/cargarSesion.php");
require_once(__DIR__."/../acceso/comprobarLogIn.php");
require_once(__DIR__."/../class/class.Usuario.php");
require_once(__DIR__."/../class/class.Medico.php");
require_once(__DIR__."/../class/class.Rol.php");
require_once(__DIR__."/../class/class.PermisosWeb.php");

// Cargamos el usuario
$usuario = new Usuario($GLOBAL_SESSION[CAMPO_DATOS_SESION]['id']);

// Cargamos los datos del Rol
$rol = new Rol($usuario->idRol);

// Recogemos la tarea a desarrollar
$tarea = $_GET['tarea'];

$limit = null;
// Si existe LIMIT, lo cargamos
if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
}

$offset = null;
// Si existe OFFSET, lo cargamos
if (isset($_GET['offset'])) {
    $offset = $_GET['offset'];
}

$search = null;
// Si existe search, lo cargamos
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$sort = null;
// Si existe search, lo cargamos
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
}

$order = null;
// Si existe search, lo cargamos
if (isset($_GET['order'])) {
    $order = $_GET['order'];
}

switch($tarea) {
    case 'getAllUsers':
        // Sólo un administrador puede acceder al listado completo de usuarios
        if ($usuario->idRol != 1) {
            exit;
        }
        $conexionDB = new GestorDB();
        $parametrosSelect = ['id','nombre','apellidos','email','idRol'];
        $datos = $conexionDB->getRecordsByParams(TABLA_USUARIOS, $parametrosSelect,null,'apellidos, nombre ASC','FETCH_ASSOC', $limit, $offset);

        // Añadimos el nombre del rol al que pertenece el usuario
        foreach($datos as $indice => $dato) {
            foreach($dato as $campo => $valor) {
                $rol = new Rol($dato['idRol']);
                $datos[$indice]['nombreRol'] = $rol->nombre;
            }
        }
        echo json_encode($datos);
        break;

        case 'getCitas':
             
        //Mostramos solamente las citas del paciente logeado 
        $clausulaWhere = TABLA_CITAS.".idPaciente = ".$usuario->id;
        $conexionDB = new GestorDB();
        $parametrosSelect = ['id','fechaHora','idPaciente','tipo'];
        $datos = $conexionDB->getRecordsByParams(TABLA_CITAS, $parametrosSelect, $clausulaWhere, 'fechaHora ASC, tipo','FETCH_ASSOC', $limit, $offset);             
        
        echo json_encode($datos);
        
        break;



   case 'getUsersByTipo':
       if ($usuario->idRol != 1) {
           exit;
       }
       $conexionDB = new GestorDB();
       $parametrosSelect = ['id','nombre','apellidos','email','idRol'];
       $datos = $conexionDB->getRecordsByParams(TABLA_USUARIOS, $parametrosSelect,null,'apellidos ASC','FETCH_ASSOC');

       // Añadimos el nombre del rol al que pertenece el usuario
       foreach($datos as $indice => $dato) {
           foreach($dato as $campo => $valor) {
               $rol = new Rol($dato['idRol']);
               $datos[$indice]['nombreRol'] = $rol->nombre;
           }
       }
       echo json_encode($datos);
       break;

    case 'getUsersForTable':
        $parametrosSelect = null;
		$clausulaWhere = null;
		$tablasSql = null;

        // Veamos si quiere a todos los usuarios o sólo a usuarios de un tipo
        $getRol = null;
        if (isset($_GET['getRol'])) {
            $getRol = $_GET['getRol'];
			
			$rolSolicitado = new Rol($getRol);
            $rolUsuario = new Rol($usuario->idRol);
			
			// Vamos a ver qué datos necesitamos en función del tipo de usuario solicitado
			switch($getRol) {
				case 1:
					// Quiere obtener datos de usuarios administradores
					$parametrosSelect = TABLA_USUARIOS.".nombre, ".TABLA_USUARIOS.".apellidos";
					$tablasSql = TABLA_USUARIOS;
					break;
					
				case 2:
					// Quiere obtener datos de usuarios médicos
					$parametrosSelect  = TABLA_USUARIOS.".id, ".$rolSolicitado->tabla.".numColegiado, ".$rolSolicitado->tabla.".idCentroSalud, ".$rolSolicitado->tabla.".idCupo, ".$rolSolicitado->tabla.".especialidad, ";
					$parametrosSelect .= TABLA_USUARIOS.".email, ".TABLA_USUARIOS.".idRol, ".TABLA_USUARIOS.".nombre, ".TABLA_USUARIOS.".apellidos, ";
					$parametrosSelect .= TABLA_CUPOS.".nombre AS nombreCupo, ".TABLA_CENTROS_SALUD.".nombre AS nombreCentroSalud ";
					$tablasSql = TABLA_USUARIOS.", ".$rolSolicitado->tabla.", ".TABLA_CUPOS.", ".TABLA_CENTROS_SALUD;
					$clausulaWhere  = TABLA_USUARIOS.".id = ".$rolSolicitado->tabla.".id";
					$clausulaWhere .= " AND ".TABLA_CUPOS.".id = ".$rolSolicitado->tabla.".idCupo";
					$clausulaWhere .= " AND ".TABLA_CENTROS_SALUD.".id = ".$rolSolicitado->tabla.".idCentroSalud";
					$clausulaWhere .= " AND ".TABLA_USUARIOS.".idRol = ".$getRol;
					break;
				
				case 3:
					// Quiere obtener datos de usuarios enfermeros
					$parametrosSelect  = TABLA_USUARIOS.".id, ".$rolSolicitado->tabla.".numColegiado, ".$rolSolicitado->tabla.".idCentroSalud, ".$rolSolicitado->tabla.".idCupo, ";
                    $parametrosSelect .= TABLA_USUARIOS.".email, ".TABLA_USUARIOS.".idRol, ".TABLA_USUARIOS.".nombre, ".TABLA_USUARIOS.".apellidos, ";
                    $parametrosSelect .= TABLA_CUPOS.".nombre AS nombreCupo, ".TABLA_CENTROS_SALUD.".nombre AS nombreCentroSalud";
                    $tablasSql = TABLA_USUARIOS.", ".$rolSolicitado->tabla.", ".TABLA_CUPOS.", ".TABLA_CENTROS_SALUD;
					$clausulaWhere = TABLA_USUARIOS.".id = ".$rolSolicitado->tabla.".id";
                    $clausulaWhere .= " AND ".TABLA_CUPOS.".id = ".$rolSolicitado->tabla.".idCupo";
                    $clausulaWhere .= " AND ".TABLA_CENTROS_SALUD.".id = ".$rolSolicitado->tabla.".idCentroSalud";
                    $clausulaWhere .= " AND ".TABLA_USUARIOS.".idRol = ".$getRol;
					break;
				
				case 4:
					// Quiere obtener datos de usuarios pacientes
					$parametrosSelect  = TABLA_USUARIOS.".id, ".$rolSolicitado->tabla.".idCentroSalud, ".$rolSolicitado->tabla.".idCupo, ";
                    $parametrosSelect .= TABLA_USUARIOS.".email, ".TABLA_USUARIOS.".idRol, ".TABLA_USUARIOS.".nombre, ".TABLA_USUARIOS.".apellidos, ";
                    $parametrosSelect .= TABLA_CUPOS.".nombre AS nombreCupo, ".TABLA_CENTROS_SALUD.".nombre AS nombreCentroSalud ";
                    $tablasSql = TABLA_USUARIOS.", ".$rolSolicitado->tabla.", ".TABLA_CUPOS.", ".TABLA_CENTROS_SALUD;
					$clausulaWhere = TABLA_USUARIOS.".id = ".$rolSolicitado->tabla.".id";
                    $clausulaWhere .= " AND ".TABLA_CUPOS.".id = ".$rolSolicitado->tabla.".idCupo";
                    $clausulaWhere .= " AND ".TABLA_CENTROS_SALUD.".id = ".$rolSolicitado->tabla.".idCentroSalud";
                    $clausulaWhere .= " AND ".TABLA_USUARIOS.".idRol = ".$getRol;
                    break;
			}

            // Quiere a usuarios de un tipo. Hay que ver a cuáles puede acceder
            switch ($usuario->idRol) {
                case 1:
                    // Administrador -> Puede acceder a cualquier conjunto de datos

                    $sortBy = 'apellidos, nombre ASC';
                    break;

                case 2:
                    // Médico -> Sólo puede acceder a los enfermeros y pacientes de su cupo
                    // Cargamos los datos del médico
                    $medico = new Medico($usuario->id);

                    // Garantizamos que el médico está en el mismo cupo que los usuarios solicitados
                    $clausulaWhere .= " AND ".$rolSolicitado->tabla.".idCupo = ".$medico->getCupo();

                    // Los médicos pueden consultar médicos, enfermeros y pacientes
                    $clausulaWhere .= " AND ".TABLA_USUARIOS.".idRol IN (2,3,4)";

                    $sortBy = 'apellidos, nombre ASC';
                    break;

                case 3:
                    // Enfermero -> Sólo puede acceder a los médicos y pacientes de su cupo
                    $enfermero = new Enfermero($usuario->id);    

                    // Garantizamos que el enfermero está en el mismo cupo que los usuarios solicitados
                    $clausulaWhere .= " AND ".$rolSolicitado->tabla.".idCupo = ".$enfermero->getCupo();

                    // Los enfermeros pueden consultar enfermeros y pacientes
                    $clausulaWhere .= " AND ".TABLA_USUARIOS.".idRol IN (3,4)";

                    $sortBy = 'apellidos, nombre ASC';

                    break;
                case 4:
                    // Paciente -> Sólo puede acceder a los médicos de su cupo             
                    $paciente = new Paciente($usuario->id);    

                    // Garantizamos que el enfermero está en el mismo cupo que los usuarios solicitados
                    $clausulaWhere .= " AND ".$rolSolicitado->tabla.".idCupo = ".$paciente->getCupo();

                    // Los pacientes pueden consultar medicos y citas
                    $clausulaWhere .= " AND ".TABLA_USUARIOS.".idRol IN (2)";
                    $clausulaWhere .= " AND ".TABLA_CITAS.".idPaciente = ".$paciente->idPaciente;

                    $sortBy = 'apellidos, nombre ASC';

                    break;
                    
                 
            }

        } else {
            // Si no se especifica tipo, sólo puede ser un administrador quien pida el listado completo de usuarios
            if ($usuario->idRol != 1) {
                exit;
            }
            $tablasSql = TABLA_USUARIOS;
            $parametrosSelect = TABLA_USUARIOS.".id, ".TABLA_USUARIOS.".nombre, ".TABLA_USUARIOS.".apellidos, ".TABLA_USUARIOS.".email, ".TABLA_USUARIOS.".idRol";
            $clausulaWhere = null;
            $sortBy = 'apellidos, nombre ASC';
        }


        if ($search != null) {
            // Se quiere buscar por parámetro de búsqueda
            if ($clausulaWhere != null) {
                $clausulaWhere .= " AND (nombre LIKE '%{$search}%'";
                $clausulaWhere .= " OR apellidos LIKE '%{$search}%')";
            } else {
                $clausulaWhere  = " nombre LIKE '%{$search}%'";
                $clausulaWhere .= " OR apellidos LIKE '%{$search}%'";
            }
        }

        $conexionDB = new GestorDB();

        // Hacemos la consulta sin limit ni offset para conocer el total de filas
        $parametrosSelectCount = TABLA_USUARIOS.'.id';
        if ($clausulaWhere == null) {
            $consultaSql = "SELECT {$parametrosSelectCount} FROM {$tablasSql}";
        } else {
            $consultaSql = "SELECT {$parametrosSelectCount} FROM {$tablasSql} WHERE {$clausulaWhere}";
        }


        try {
            $consultaSqlDB = $conexionDB->dbh->prepare($consultaSql);
            $consultaSqlDB->execute();
            $datos = $consultaSqlDB->fetchAll(constant('PDO::FETCH_ASSOC'));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $totalDatos = count($datos);

        // Hacemos la consulta con el limit y el offset
        $consultaSql  = "SELECT {$parametrosSelect} FROM {$tablasSql} ";
        if ($clausulaWhere != null) {
            $consultaSql .= " WHERE {$clausulaWhere} ";
        }

        if ($sort != null) {
            $consultaSql .= "ORDER BY {$sort} {$order}";
        } else {
            if ($sortBy != null) {
                $consultaSql .= " ORDER BY {$sortBy} ";
            }
        }

        if ($limit != null) {
            $consultaSql .= " LIMIT {$limit} ";
        }

        if ($offset != null) {
            $consultaSql .= " OFFSET {$offset} ";
        }


        try {
            $consultaSqlDB = $conexionDB->dbh->prepare($consultaSql);
            $consultaSqlDB->execute();
            $datos = $consultaSqlDB->fetchAll(constant('PDO::FETCH_ASSOC'));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


        // Añadimos el nombre del rol al que pertenece el usuario
        foreach($datos as $indice => $dato) {
            foreach($dato as $campo => $valor) {
                $rol = new Rol($dato['idRol']);
                $datos[$indice]['nombreRol'] = $rol->nombre;
            }
        }

        $resultado = array();
        $resultado['total'] = $totalDatos;
        $resultado['rows'] = $datos;

        echo json_encode($resultado);
        break;
}
?>
