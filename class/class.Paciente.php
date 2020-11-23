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
 
     public function guardar() {
        $gestorDB = new GestorDB();

        if ($this->id != 0) {
            // Hay que hacer un UPDATE
            // Variables para la tabla USUARIOS
            $datosUsuario = array('id' => $this->id,
                            'idRol' => $this->idRol,
                            'nombre' => $this->nombre,
                            'apellidos' => $this->apellidos,
                            'email' => $this->email,
                            'password' => $this->password,
                            'fechaNacimiento' => $this->fechaNacimiento,
                            'direccion' => $this->direccion,
                            'cp' => $this->cp,
                            'numIntentosLogin' => $this->numIntentosLogin,
                            'ultimoAcceso' => $this->ultimoAcceso,
                            'bloqueado' => $this->bloqueado
                            );

            $datosPaciente = array('id' => $this->id,
                            'numHistoria' => $this->numHistoria,
                            'idCentroSalud' => $this->idCentroSalud,
                            'idCupo' => $this->idCupo,
                            'especialidad' => $this->especialidad
            );
            $clavesPrimarias = array('id' => $this->id);

            // Actualizamos la tabla de Usuarios
            $resultadoUsuario = $gestorDB->updateDB(TABLA_USUARIOS,$datosUsuario,$clavesPrimarias);
            if ($resultadoUsuario instanceof PDOException) {
                // Ha ocurrido un error
                // Hay que insertar en el log
                return false;
            }

            // Actualizamos la tabla de Médicos
            $resultadoMedico = $gestorDB->updateDB(TABLA_PACIENTES,$datosPaciente,$clavesPrimarias);
            if ($resultadoMedico instanceof PDOException) {
                // Ha ocurrido un error
                // Hay que insertar en el log
                return false;
            }

            return true;


        } else {
            // Hay que hacer un INSERT
            $datosUsuario = array('id' => $this->id,
                'idRol' => $this->idRol,
                'nombre' => $this->nombre,
                'apellidos' => $this->apellidos,
                'email' => $this->email,
                'password' => $this->password,
                'fechaNacimiento' => $this->fechaNacimiento,
                'direccion' => $this->direccion,
                'cp' => $this->cp,
                'numIntentosLogin' => $this->numIntentosLogin,
                'ultimoAcceso' => $this->ultimoAcceso,
                'bloqueado' => $this->bloqueado
            );

            // Insertamos al usuario en la tabla de Usuarios
            $resultadoUsuario = $gestorDB->insertIntoDB(TABLA_USUARIOS,$datosUsuario,['id']);
            if ($resultadoUsuario instanceof PDOException) {
                // Ha ocurrido un error
                // Hay que insertar en el log
                echo $resultadoUsuario->getMessage();
                return false;
            } else {
                $this->id = $resultadoUsuario;
            }

            $datosPaciente = array('id' => $this->id,
                'numHistoria' => $this->numHistoria,
                'idCentroSalud' => $this->idCentroSalud,
                'idCupo' => $this->idCupo,
                'especialidad' => $this->especialidad
            );

            // Insertamos al médico en la tabla de médicos
            $resultadoMedico = $gestorDB->insertIntoDB(TABLA_PACIENTES,$datosPaciente,[]);
            if ($resultadoMedico instanceof PDOException) {
                // Ha ocurrido un error
                // Hay que insertar en el log
                echo $resultadoMedico->getMessage();
                return false;
            }

            return true;
        }
    }
}

?>



