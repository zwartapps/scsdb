<?php

require_once __DIR__.'/../db/class.GestorDB.php';

class Cupo {
    protected $id;
    protected $nombre;
    protected $idCentroSalud;       

    public function __construct($id = 0) {
        if ($id != 0) {
            // Consultamos los datos por id en la BD
            $gestorDB = new GestorDB();
            $registros = $gestorDB->getRecordsByParams(TABLA_CUPOS, ['*'], 'id = '.$id, NULL, 'FETCH_ASSOC');
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

// Devuelve un array en PHP con los datos de todos los cupos, pudiendo especificar o no un centro de salud en concreto
function cargarCupos($tipoFetch = 'FETCH_ASSOC',$idCentroSalud = 0) {
	$gestorDB = new GestorDB();
	if ($idCentroSalud != 0) {
		$registros = $gestorDB->getRecordsByParams(TABLA_CUPOS, ['*'], 'idCentroSalud = '.$idCentroSalud, NULL, $tipoFetch);
	} else {
		$registros = $gestorDB->getRecordsByParams(TABLA_CUPOS, ['*'], NULL, NULL, $tipoFetch);
	}	
	return $registros;
}

?>
