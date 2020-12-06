<?php

require_once __DIR__.'/../db/class.GestorDB.php';

class Cita {
    protected $id;
    protected $fechaHora;
    protected $idPaciente;       
    protected $tipo;
    protected $plantilla;
    
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
            // Variables para la tabla CITAS
            $datosCita = array(
                'id' => $this->id,
                'tipo' => $this->tipo,
                'fechaHora' => $this->fechaHora,
                'idPaciente' => $this->idPaciente                
            );
            
            $clavesPrimarias = array('id' => $this->id);
            
            // Actualizamos la tabla de Citas
            $resultadoCita = $gestorDB->updateDB(TABLA_CITAS, $datosCita, $clavesPrimarias);
            if ($resultadoCita instanceof PDOException) {
                // Ha ocurrido un error
                // Hay que insertar en el log
                return false;
            } 
            
            return true;
        } else {
            // Hay que hacer un INSERT
            $datosCita = array(
                'id' => $this->id,
                'tipo' => $this->tipo,
                'fechaHora' => $this->fechaHora,
                'idPaciente' => $this->idPaciente       
            );
            
            // Insertamos la cita en la tabla de Citas
            $resultadoCita = $gestorDB->insertIntoDB(TABLA_CITAS, $datosCita, ['id']);
            if ($resultadoCita instanceof PDOException) {
                // Ha ocurrido un error
                // Hay que insertar en el log
                echo $resultadoCita->getMessage();
                return false;
            } else {
                $this->id = $resultadoCita;
            } 
            return true;
        }
    } 
    
    public function eliminar() {
        $gestorDB = new GestorDB();
        $clavesPrimarias = array('id' => $this->id);
        $resultado = $gestorDB->deleteDB(TABLA_CITAS, $clavesPrimarias);
        
    }
    
    public function getAtributos() {
        return get_object_vars($this);
    }
    
    
    
}

// Devuelve un array en PHP con los datos de todos las citas
function cargarCitas ($tipoFetch = 'FETCH_ASSOC') {
    $gestorDB = new GestorDB();
    $registros = $gestorDB->getRecordsByParams(TABLA_CITAS, ['*'], NULL, NULL, $tipoFetch);
    
    return $registros;       
}
