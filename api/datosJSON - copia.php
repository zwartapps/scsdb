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
        $clausulaWhere = null;
        // Veamos si quiere a todos los usuarios o sólo a usuarios de un tipo
        $getRol = null;
        if (isset($_GET['getRol'])) {
            $getRol = $_GET['getRol'];

            $rolSolicitado = new Rol($getRol);
            $rolUsuario = new Rol($getRol);

            // Quiere a usuarios de un tipo. Hay que ver a cuáles puede acceder
            switch ($usuario->idRol) {
                case 1:
                    // Administrador -> Puede acceder a cualquier conjunto de datos
                    $parametrosSelect = [TABLA_USUARIOS.'.id','nombre','apellidos','email','idRol'];
                    $tablasSql = TABLA_USUARIOS;
                    $clausulaWhere = TABLA_USUARIOS.".idRol = ".$getRol;

                    $sortBy = 'apellidos, nombre ASC';
                    break;

                case 2:
                    // Médico -> Sólo puede acceder a los enfermeros y pacientes de su cupo
                    // Cargamos los datos del médico
                    $medico = new Medico($usuario->id);

                    $parametrosSelect = [TABLA_USUARIOS.'.id','nombre','apellidos','email','idRol'];
                    $tablasSql = TABLA_USUARIOS.", ".$rolSolicitado->tabla;
                    $clausulaWhere  = TABLA_USUARIOS.".id = ".$rolSolicitado->tabla.".id";
                    $clausulaWhere .= " AND ".$rolSolicitado->tabla.".idCupo = ".$medico->getCupo();
                    $clausulaWhere .= " AND ".TABLA_USUARIOS.".idRol IN (2,3,4)";

                    $sortBy = 'apellidos, nombre ASC';
                    break;

                case 3:
                    // Enfermero -> Sólo puede acceder a los médicos y pacientes de su cupo
                    break;
                case 4:
                    // Paciente -> Sólo puede acceder a los médicos y enfermeros de su cupo
                    break;
            }

        } else {
            // Si no se especifica tipo, sólo puede ser un administrador quien pida el listado completo de usuarios
            if ($usuario->idRol != 1) {
                exit;
            }
            $tablasSql = TABLA_USUARIOS;
            $parametrosSelect = [TABLA_USUARIOS.'.id','nombre','apellidos','email','idRol'];
            $clausulaWhere = null;
            $sortBy = 'apellidos, nombre ASC';
        }

        $conexionDB = new GestorDB();

        if ($search != null) {
            // Se quiere buscar por parámetro de búsqueda
            if ($clausulaWhere != null) {
                $clausulaWhere .= " AND (nombre LIKE '%{$search}%'";
                $clausulaWhere .= " OR apellidos LIKE '%{$search}%')";
            } else {
                $clausulaWhere = " nombre LIKE '%{$search}%'";
                $clausulaWhere .= " OR apellidos LIKE '%{$search}%'";
            }
        }

        // Hacemos la consulta sin limit ni offset para conocer el total de filas
        $parametrosSelectCount = [TABLA_USUARIOS.'.id'];
        $datos = $conexionDB->getRecordsByParams($tablasSql, $parametrosSelectCount,$clausulaWhere,null,'FETCH_ASSOC');
        $totalDatos = count($datos);

        // Hacemos la consulta con el limit y el offset
        $datos = $conexionDB->getRecordsByParams($tablasSql, $parametrosSelect,$clausulaWhere,$sortBy,'FETCH_ASSOC', $limit, $offset);

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
