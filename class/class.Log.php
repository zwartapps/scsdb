<?php
require_once __DIR__ . '/../db/class.GestorDB.php';

class Log
{
    public $id;
    public $idUsuario;
    public $observaciones = "";
    public $ip = "";
    public $FechaHora = "";
    public $navegador = "";
    public $sistemaOperativo = "";

    public function __construct($id = 0)
    {

        if ($id != 0) {
            // Buscamos el error en la BD
            $gestorDB = new GestorDB();
            $datosRequeridos = ['*'];
            $clausulaWhere = 'id = ' . $id;
            $datos = $gestorDB->getRecordsByParams(TABLA_LOG, $datosRequeridos, $clausulaWhere, null, 'FETCH_ASSOC');
            foreach ($datos as $dato) {
                foreach ($dato as $campo => $valor) {
                    $this->$campo = $valor;
                }
            }
        }
    }

    public function getId()
    {
        return $this->id;
    }



    public function guardar()
    {
        if ($this->id != 0) {
            $gestorDB = new GestorDB();

            $datosError = array(
                'id' => $this->id,
                'observaciones' => $this->observaciones

            );

            // Hay que hacer un INSERT
            $resultado = $gestorDB->insertIntoDB(TABLA_LOG, $datosError, ['id']);
            if ($resultado instanceof PDOException) {
                return false;
            } else {
                $this->id = $resultado;
                return true;
            }
        }
    }

    public function __get($atributo) {
        if (property_exists($this,$atributo)) {
            return $this->$atributo;
        }
        return false;
    }


}
