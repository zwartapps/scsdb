<?php
require_once __DIR__.'/../db/class.GestorDB.php';

class Log {
    protected $id;
    protected $idUsuario;
    protected $observaciones="";
    protected $ip = "";
    protected $FechaHora = "";
    protected $navegador = "";
    protected $sistemaOperativo = "";
    
    public function __construct($id = 0) {
        
        if ($id != 0) {
            // Buscamos el error en la BD
            $gestorDB = new GestorDB();
            $datosRequeridos = ['*'];
            $clausulaWhere = 'id = '.$id;
            $datos = $gestorDB->getRecordsByParams(TABLA_LOG, $datosRequeridos, $clausulaWhere, null,'FETCH_ASSOC');
            foreach($datos as $dato) {
                foreach($dato as $campo => $valor) {
                    $this->$campo = $valor;
                }
            }
        }
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function guardar() {
        $gestorDB = new GestorDB();

        // Hay que hacer un INSERT
        $resultado = $gestorDB->insertIntoDB(TABLA_LOG, get_object_vars($this),['id']);
        if ($resultado instanceof PDOException) {
            return false;
        } else {
            $this->id = $resultado;
            return true;
        }
    }    
}

?>
    