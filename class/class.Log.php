<?php

require_once __DIR__.'/../db/class.GestorDB.php';


class Log {
    protected $id;
    protected $idUsuario;
    protected $observaciones = "";
    protected $ip = "";
    protected $fechaHora = "";
    protected $navegador = "";
    protected $sistemaOperativo = "";


    public function __construct($id = 0) {

        if ($id != 0) {
           
            $gestorDB = new GestorDB();
            $datosRequeridos = ['*'];
            $clausulaWhere = 'id = '.$id;
            $datos = $gestorDB->getRecordsByParams(TABLA_LOG,$datosRequeridos,$clausulaWhere,null,'FETCH_ASSOC');
            foreach($datos as $dato) {
                foreach($dato as $campo => $valor) {
                    $this->$campo = $valor;
                }
            }
        }
    }

    public function guardar() {
        $gestorDB = new GestorDB();
        $resultado = $gestorDB->insertIntoDB(TABLA_LOG,get_object_vars($this),['id']);
            if ($resultado instanceof PDOException) {
                // Ha ocurrido un error
                // Hay que insertar en el log
                return false;
            } else {
                $this->id = $resultado;
                return true;
            }
      
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