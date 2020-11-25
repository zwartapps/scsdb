<?php

require_once __DIR__.'/../db/class.GestorDB.php';

class Usuario {
    protected $id;
    protected $idRol;
    protected $nombre;
    protected $apellidos;
    protected $email;
    protected $password;
    protected $fechaNacimiento;
    protected $direccion;
    protected $cp;
    protected $numIntentosLogin;
    protected $ultimoAcceso;
    protected $bloqueado;
 
    const HASH = PASSWORD_DEFAULT;
    const HASH_COST = 10;

    public function __construct($id = 0, $email = null) {
        if ($id != 0) {
            // Consultamos los datos por id en la BD
            $gestorDB = new GestorDB();
            $registros = $gestorDB->getRecordsByParams(TABLA_USUARIOS,['*'],'id = '.$id,NULL,'FETCH_ASSOC');
            foreach ($registros as $registro) {
                foreach ($registro as $campo => $valor) {
                    $this->$campo = $valor;
                }
            }
        } else {
            if ($email != null) {
                // Consultamos los datos por email en la BD
                $gestorDB = new GestorDB();
                $registros = $gestorDB->getRecordsByParams(TABLA_USUARIOS,['*'],"email = '".$email."'",NULL,'FETCH_ASSOC');
                foreach ($registros as $registro) {
                    foreach ($registro as $campo => $valor) {
                        $this->$campo = $valor;
                    }
                }
            }
        }
        return true;
    }

    public function setPassword($password) {
        $this->password = password_hash($password, self::HASH, ['cost' => self::HASH_COST]);
    }

    public function getPassword() {
        return $this->password;
    }

    public function checkPassword($password) {
        return password_verify($password, $this->password);
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

    public function guardar() {
        $gestorDB = new GestorDB();

        if ($this->id != 0) {
            // Hay que hacer un UPDATE
            $clavesPrimarias = array('id' => $this->id);
            $resultado = $gestorDB->updateDB(TABLA_USUARIOS,get_object_vars($this),$clavesPrimarias);
            if ($resultado instanceof PDOException) {
                // Ha ocurrido un error
                // Hay que insertar en el log
                return false;
            } else {
                return true;
            }
        } else {
            // Hay que hacer un INSERT
            $resultado = $gestorDB->insertIntoDB(TABLA_USUARIOS,get_object_vars($this),['id']);
            if ($resultado instanceof PDOException) {
                // Ha ocurrido un error
                // Hay que insertar en el log
                return false;
            } else {
                $this->id = $resultado;
                return true;
            }
        }
    }

    public function eliminar() {
        $gestorDB = new GestorDB();
        $clavesPrimarias = array('id' => $this->id);
        $resultado = $gestorDB->deleteDB(TABLA_USUARIOS,$clavesPrimarias);
    }

    public function getEdad() {
        $fechaNacimientoDT = new DateTime($this->fechaNacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fechaNacimientoDT);
        return $edad->y;
    }

    public function getAtributos() {
        return get_object_vars($this);
    }
}

?>
