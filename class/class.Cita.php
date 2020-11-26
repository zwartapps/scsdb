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
}

// Devuelve un array en PHP con los datos de todos las citas
function cargarCitas($tipoFetch = 'FETCH_ASSOC',$idPaciente = 0) {
	$gestorDB = new GestorDB();
	if ($idPaciente != 0) {
        $registros = $gestorDB->getRecordsByParams(TABLA_CITAS, ['*'], 'idPaciente = '.$idPaciente, NULL, $tipoFetch);
        return $registros;
	} 	
	
}

?>
