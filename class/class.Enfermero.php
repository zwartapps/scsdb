<?php
require_once __DIR__ . '/../db/class.GestorDB.php';
require_once __DIR__ . '/class.Rol.php';

class Enfermero extends Usuario
{
    protected $id;
    protected $numColegiado;
    protected $idCentroSalud = "";
    protected $idCupo = "";

    public function __construct($id = 0)
    {

        parent::__construct($id);

        if ($id != 0) {
            // Buscamos el enfermero en la BD
            $gestorDB = new GestorDB();
            $datosRequeridos = ['*'];
            $clausulaWhere = 'id = ' . $id;
            $datos = $gestorDB->getRecordsByParams(TABLA_ENFERMEROS, $datosRequeridos, $clausulaWhere, null, 'FETCH_ASSOC');
            foreach ($datos as $dato) {
                foreach ($dato as $campo => $valor) {
                    $this->$campo = $valor;
                }
            }
        }
    }

    //devuelve el Cupo
    public function getCupo()
    {
        return $this->idCupo;
    }

    //devuelve el id
    public function getId()
    {
        return $this->id;
    }

    //Obtener el Centro Sanitario
    public function getCentroSanitario()
    {
        return $this->idCentroSalud;
    }

    //ver si es mi paciente
    public function esMiPaciente($idPaciente)
    {
        $paciente = new Paciente($idPaciente);
        if ($this->idCupo == $paciente->idCupo) {
            return true;
        }
        return false;
    }

    //Ver si es mi medico
    public function esMiMedico($idMedico)
    {
        $medico = new Medico($idMedico);
        if ($this->idCupo == $medico->idCupo) {
            return true;
        }
        return false;
    }

     //Obtener el medico
     public function getMedico()
     {
         $gestorDB = new GestorDB();
         $datosRequeridos = ['id'];
         $datos = $gestorDB->getRecordsByParams(TABLA_MEDICOS, $datosRequeridos, "idCupo = " . $this->idCupo, null, 'FETCH_ASSOC');
         return $datos[0]['id'];
     }


    public function guardar()
    {
        $gestorDB = new GestorDB();

        if ($this->id != 0) {
            // Hay que hacer un UPDATE
            // Variables para la tabla USUARIOS
            $datosUsuario = array(
                'id' => $this->id,
                'idRol' => $this->idRol,
                'nombre' => $this->nombre,
                'apellidos' => $this->apellidos,
                'email' => $this->email,
                'password' => $this->password,
                'fechaNacimiento' => $this->fechaNacimiento,
                'direccion' => $this->direccion,
                'cp' => $this->cp,
                'numIntentosLogin' => $this->numIntentosLogin,
                'ultimoAcceso' => $this->ultimoAcceso,
                'bloqueado' => $this->bloqueado
            );

            $datosEnfermero = array(
                'id' => $this->id,
                'numColegiado' => $this->numColegiado,
                'idCentroSalud' => $this->idCentroSalud,
                'idCupo' => $this->idCupo
            );
            $clavesPrimarias = array('id' => $this->id);

            // Actualizamos la tabla de Usuarios
            $resultadoUsuario = $gestorDB->updateDB(TABLA_USUARIOS, $datosUsuario, $clavesPrimarias);
            if ($resultadoUsuario instanceof PDOException) {
                // Ha ocurrido un error    
                $error = new Log();
                $error->idUsuario = $this->id;
                $error->observaciones = $resultadoUsuario->getMessage();
                $error->ip = $_SERVER['REMOTE_ADDR'];
                $error->fechaHora = date('Y-m-d H:i:s');
                $error->navegador = get_browser();
                $error->navegador = $_SERVER['HTTP_USER_AGENT'];
                $error->sistemaOperativo = PHP_OS;
                $error->guardar();
                return false;
            }

            // Actualizamos la tabla de Enfermeros
            $resultadoEnfermero = $gestorDB->updateDB(TABLA_ENFERMEROS, $datosEnfermero, $clavesPrimarias);
            if ($resultadoEnfermero instanceof PDOException) {
                // Ha ocurrido un error    
                $error = new Log();
                $error->idUsuario = $this->id;
                $error->observaciones = $resultadoEnfermero->getMessage();
                $error->ip = $_SERVER['REMOTE_ADDR'];
                $error->fechaHora = date('Y-m-d H:i:s');
                $error->navegador = get_browser();
                $error->navegador = $_SERVER['HTTP_USER_AGENT'];
                $error->sistemaOperativo = PHP_OS;
                $error->guardar();
                return false;
                return false;
            }
            return true;
        } else {
            // Hay que hacer un INSERT
            $datosUsuario = array(
                'id' => $this->id,
                'idRol' => $this->idRol,
                'nombre' => $this->nombre,
                'apellidos' => $this->apellidos,
                'email' => $this->email,
                'password' => $this->password,
                'fechaNacimiento' => $this->fechaNacimiento,
                'direccion' => $this->direccion,
                'cp' => $this->cp,
                'numIntentosLogin' => $this->numIntentosLogin,
                'ultimoAcceso' => $this->ultimoAcceso,
                'bloqueado' => $this->bloqueado
            );

            // Insertamos al usuario en la tabla de Usuarios
            $resultadoUsuario = $gestorDB->insertIntoDB(TABLA_USUARIOS, $datosUsuario, ['id']);
            if ($resultadoUsuario instanceof PDOException) {
                // Ha ocurrido un error    
                $error = new Log();
                $error->idUsuario = $this->id;
                $error->observaciones = $resultadoUsuario->getMessage();
                $error->ip = $_SERVER['REMOTE_ADDR'];
                $error->fechaHora = date('Y-m-d H:i:s');
                $error->navegador = get_browser();
                $error->navegador = $_SERVER['HTTP_USER_AGENT'];
                $error->sistemaOperativo = PHP_OS;
                $error->guardar();
                return false;
            } else {
                $this->id = $resultadoUsuario;
            }

            $datosEnfermero = array(
                'id' => $this->id,
                'numColegiado' => $this->numColegiado,
                'idCentroSalud' => $this->idCentroSalud,
                'idCupo' => $this->idCupo
            );

            // Insertamos al enfermero en la tabla de enfermeros
            $resultadoMedico = $gestorDB->insertIntoDB(TABLA_ENFERMEROS, $datosEnfermero, []);
            if ($resultadoMedico instanceof PDOException) {
                // Ha ocurrido un error    
                $error = new Log();
                $error->idUsuario = $this->id;
                $error->observaciones = $resultadoMedico->getMessage();
                $error->ip = $_SERVER['REMOTE_ADDR'];
                $error->fechaHora = date('Y-m-d H:i:s');
                $error->navegador = get_browser();
                $error->navegador = $_SERVER['HTTP_USER_AGENT'];
                $error->sistemaOperativo = PHP_OS;
                $error->guardar();
                return false;
            }
            return true;
        }
    }

    public function __set($atributo, $valor)
    {
        if (property_exists($this, $atributo)) {
            $this->$atributo = $valor;
            return true;
        }
        return false;
    }

    public function __get($atributo)
    {
        if (property_exists($this, $atributo)) {
            return $this->$atributo;
        }
        return false;
    }

    public function getAtributos()
    {
        return get_object_vars($this);
    }
}
