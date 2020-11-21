<?php

require_once __DIR__.'/../db/class.GestorDB.php';
require_once __DIR__.'/class.Rol.php';

class Paciente extends Usuario {
    protected $id;
    protected $numHistoria;
    protected $idCentroSalud = "";
    protected $idCupo = "";

    public function __construct($id = 0) {

        parent::__construct($id);

        if ($id != 0) {
            // Buscamos el paciente en la BD
            $gestorDB = new GestorDB();
            $datosRequeridos = ['*'];
            $clausulaWhere = 'id = '.$id;
            $datos = $gestorDB->getRecordsByParams(TABLA_PACIENTES, $datosRequeridos, $clausulaWhere, null,'FETCH_ASSOC');
            foreach($datos as $dato) {
                foreach($dato as $campo => $valor) {
                    $this->$campo = $valor;
                }
            }
        }
    }

    public function getCupo() {
        return $this->idCupo;
     }
 




}