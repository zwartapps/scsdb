<?php
require_once __DIR__.'/../db/class.GestorDB.php';

class PermisosWeb {
    protected $idRol;
    protected $nombreWeb;
    protected $permitido;

    public function __construct($idRol = 0, $nombreWeb = null) {
        if ($idRol != 0) {
            // Consultamos los datos por id en la BD
            $gestorDB = new GestorDB();
            $registros = $gestorDB->getRecordsByParams(TABLA_PERMISOS_WEB, ['*'], "idRol = ".$idRol." AND nombreWeb = '".$nombreWeb."'", NULL, 'FETCH_ASSOC');
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

?>
