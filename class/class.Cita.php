<?php

require_once __DIR__.'/../db/class.GestorDB.php';

class Cita {
    protected $id;
    protected $fechaHora;
    protected $idPaciente;       
    protected $tipo;
    
    public function __construct($id = 0) {
        if ($id != 0) {
            // Consultamos los datos por id en la BD
            $gestorDB = new GestorDB();
            $registros = $gestorDB->getRecordsByParams(TABLA_CITAS, ['*'], 'id = '.$id, NULL, 'FETCH_ASSOC');
            foreach ($registros AS $registro) {
                foreach ($registro AS $campo => $valor) {
                    $this->$campo = $valor;
                }
            }
        }
        return true;
    }
    
    public function __set($atributo, $valor) {
        if (property_exists($this,$atributo)) {
            $this->$atributo = $valor;
            return true;
        }
        return false;
    }
    
    public function __get($atributo) {
        if (property_exists($this,$atributo)) {
            return $this->$atributo;
        }
        return false;
    }
    
    
    public function guardar() {
        $gestorDB = new GestorDB();
        
        if ($this->id != 0) {
            // Hay que hacer un UPDATE
            // Variables para la tabla USUARIOS
            $datosCita = array(
                'id' => $this->id,
                'tipo' => $this->tipo,
                'fechaHora' => $this->fechaHora,
                'idPaciente' => $this->idPaciente                
            );
            
            $datosPaciente = array(
                'id' => $this->id,
                'idCentroSalud' => $this->idCentroSalud,
                'idCupo' => $this->idCupo,
                'numHistoria' => $this->numHistoria
            );
            $clavesPrimarias = array('id' => $this->id);
            
            // Actualizamos la tabla de Citas
            $resultadoCita = $gestorDB->updateDB(TABLA_CITAS, $datosCita, $clavesPrimarias);
            if ($resultadoCita instanceof PDOException) {
                // Ha ocurrido un error
                // Hay que insertar en el log
                return false;
            }
            
            /* Actualizamos la tabla de Pacientes
            $resultadoUsuario = $gestorDB->updateDB(TABLA_PACIENTES, $datosPaciente, $clavesPrimarias);
            if ($resultadoUsuario instanceof PDOException) {
                // Ha ocurrido un error
                // Hay que insertar en el log
                return false;
            }*/
            
            return true;
        } else {
            // Hay que hacer un INSERT
            $datosCita = array(
                'id' => $this->id,
                'tipo' => $this->tipo,
                'fechaHora' => $this->fechaHora,
                'idPaciente' => $this->idPaciente       
            );
            
            /* Insertamos al usuario en la tabla de Usuarios
            $resultadoUsuario = $gestorDB->insertIntoDB(TABLA_USUARIOS, $datosUsuario, ['id']);
            if ($resultadoUsuario instanceof PDOException) {
                // Ha ocurrido un error
                // Hay que insertar en el log
                echo $resultadoUsuario->getMessage();
                return false;
            } else {
                $this->id = $resultadoUsuario;
            }
           
            $datosPaciente = array(
                'id' => $this->id,
                'numHistoria' => $this->numHistoria,
                'idCentroSalud' => $this->idCentroSalud,
                'idCupo' => $this->idCupo
            );
            
            // Insertamos al médico en la tabla de pacientes
            $datosPaciente = $gestorDB->insertIntoDB(TABLA_PACIENTES, $datosPaciente, []);
            if ($datosPaciente instanceof PDOException) {
                // Ha ocurrido un error
                // Hay que insertar en el log
                echo $datosPaciente->getMessage();
                return false;
            }*/
            
            return true;
        }
    }
    
     
    
   
    
}

 // Devuelve un array en PHP con los datos de todos las citas
 function cargarCitas ($tipoFetch = 'FETCH_ASSOC') {
    $gestorDB = new GestorDB();
    $registros = $gestorDB->getRecordsByParams(TABLA_CITAS, ['*'], NULL, NULL, $tipoFetch);

    return $registros;       
}

?>
