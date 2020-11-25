<?php

require_once __DIR__ . '/../db/class.GestorDB.php';
require_once __DIR__ . '/class.Rol.php';

class Medico extends Usuario
{
    protected $id;
    protected $numColegiado;
    protected $idCentroSalud = "";
    protected $idCupo = "";
    protected $especialidad = "";    
    
    
    public function __construct($id = 0)
    {
        
        parent::__construct($id);
        
        if ($id != 0) {
            // Buscamos el médico en la BD
            $gestorDB = new GestorDB();
            $datosRequeridos = ['*'];
            $clausulaWhere = 'id = ' . $id;
            $datos = $gestorDB->getRecordsByParams(TABLA_MEDICOS, $datosRequeridos, $clausulaWhere, null, 'FETCH_ASSOC');
            foreach ($datos as $dato) {
                foreach ($dato as $campo => $valor) {
                    $this->$campo = $valor;
                }
            }
        }
    }
    
    public function getCupo() {
        return $this->idCupo;
    }
    
    //Metodos de la Tarea
    public function getCentroSanitario() {
        return $this->idCentroSalud;
    }
    
    public function getEnfermero() {
        $cupoMedico = $this->idCupo;
        $enfermero = new Enfermero();
        $cupoEnfermero = $enfermero->getCupo();
  
        if ($cupoMedico == $cupoEnfermero) {
            $idEnfermero = $enfermero->getId();
        }
        return $idEnfermero;
    }
    
    public function esMiPaciente($id) {
        $paciente = new Paciente();
        
        if($this->idCupo == $paciente->idCupo){
            return true;
        }  
        return false; 
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
            
            $datosMedico = array(
                'id' => $this->id,
                'numColegiado' => $this->numColegiado,
                'idCentroSalud' => $this->idCentroSalud,
                'idCupo' => $this->idCupo,
                'especialidad' => $this->especialidad
            );
            $clavesPrimarias = array('id' => $this->id);
            
            // Actualizamos la tabla de Usuarios
            $resultadoUsuario = $gestorDB->updateDB(TABLA_USUARIOS, $datosUsuario, $clavesPrimarias);
            if ($resultadoUsuario instanceof PDOException) {
                // Ha ocurrido un error
                // Hay que insertar en el log
                return false;
            }
            
            // Actualizamos la tabla de Médicos
            $resultadoMedico = $gestorDB->updateDB(TABLA_MEDICOS, $datosMedico, $clavesPrimarias);
            if ($resultadoMedico instanceof PDOException) {
                // Ha ocurrido un error
                // Hay que insertar en el log
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
                // Hay que insertar en el log
                echo $resultadoUsuario->getMessage();
                return false;
            } else {
                $this->id = $resultadoUsuario;
            }
            
            $datosMedico = array(
                'id' => $this->id,
                'numColegiado' => $this->numColegiado,
                'idCentroSalud' => $this->idCentroSalud,
                'idCupo' => $this->idCupo,
                'especialidad' => $this->especialidad
            );
            
            // Insertamos al médico en la tabla de médicos
            $resultadoMedico = $gestorDB->insertIntoDB(TABLA_MEDICOS, $datosMedico, []);
            if ($resultadoMedico instanceof PDOException) {
                // Ha ocurrido un error
                // Hay que insertar en el log
                echo $resultadoMedico->getMessage();
                return false;
            }
            
            return true;
        }
    }
}
