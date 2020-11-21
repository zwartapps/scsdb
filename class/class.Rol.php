<?php

require_once __DIR__.'/../db/class.GestorDB.php';

class Rol {
    protected $id;
    protected $nombre;
    protected $tabla;
    protected $tablaCupo;
    protected $plantilla;
    protected $plantillaForm;
    protected $clase;
    protected $indexWeb;
    protected $menuWeb;

    public function __construct($id = 0) {
        if ($id != 0) {
            // Consultamos los datos por id en la BD
            $gestorDB = new GestorDB();
            $registros = $gestorDB->getRecordsByParams(TABLA_ROLES, ['*'], 'id = '.$id, NULL, 'FETCH_ASSOC');
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

// Devuelve un array en PHP con los datos de todos los roles del Sistema
function cargarRoles($tipoFetch = 'FETCH_ASSOC') {
	$gestorDB = new GestorDB();
	$registros = $gestorDB->getRecordsByParams(TABLA_ROLES, ['*'], NULL, NULL, $tipoFetch);
	
	return $registros;
}

?>
