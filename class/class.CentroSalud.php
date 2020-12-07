<?php
require_once __DIR__.'/../db/class.GestorDB.php';

class CentroSalud {
    protected $id;
    protected $nombre;
    protected $direccion;
    protected $telefono;

    public function __construct($id = 0) {
        if ($id != 0) {
            // Consultamos los datos por id en la BD
            $gestorDB = new GestorDB();
            $registros = $gestorDB->getRecordsByParams(TABLA_CENTROS_SALUD, ['*'], 'id = '.$id, NULL, 'FETCH_ASSOC');
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

function cargarCentrosSalud($tipoFetch = 'FETCH_ASSOC') {
	$gestorDB = new GestorDB();
	$registros = $gestorDB->getRecordsByParams(TABLA_CENTROS_SALUD, ['*'], NULL, NULL, $tipoFetch);
	
	return $registros;
}

?>
