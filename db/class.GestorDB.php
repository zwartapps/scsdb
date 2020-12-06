<?php
/******************************************************************************
 * Gestión de la Base de Datos
 ******************************************************************************/

// Variables de la BD
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "scs");

// Variables de las tablas
define("TABLA_USUARIOS",'usuarios');
define("TABLA_ROLES",'roles');
define("TABLA_CUPOS",'cupos');
define("TABLA_CENTROS_SALUD",'centros_salud');
define("TABLA_PERMISOS_WEB",'permisos_web');
define("TABLA_MEDICOS",'medicos');
define("TABLA_ENFERMEROS",'enfermeros');
define("TABLA_PACIENTES",'pacientes');
define("TABLA_CITAS", 'citas');
define("TABLA_LOG", 'log');

class GestorDB {
    private $DB_HOST = DB_HOST;
    private $DB_USER = DB_USER;
    private $DB_PASSWORD = DB_PASSWORD;
    private $DB_NAME = DB_NAME;

    public $dbh;
    public $error;

    public function __construct($db_host = null, $db_user = null, $db_password = null, $db_name = null) {

        if ($db_host != null) {
            $this->DB_HOST = $db_host;
        }

        if ($db_user != null) {
            $this->DB_USER = $db_user;
        }

        if ($db_password != null) {
            $this->DB_PASSWORD = $db_password;
        }

        if ($db_name != null) {
            $this->DB_NAME = $db_name;
        }

        try {
            $dsn = "mysql:host={$this->DB_HOST};dbname={$this->DB_NAME}";
            $this->dbh = new PDO($dsn, $this->DB_USER, $this->DB_PASSWORD);
            $this->dbh->exec("set names utf8");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }

    public function getRecordsByParams($tabla,$datosRequeridos,$clausulaWhere,$ordenSeleccion,$tipoFetch, $limit = null, $offset = null, $search = null) {
        // Preparamos la consulta
        $sqlParametrosSelect = implode(",",$datosRequeridos);
        $consultaSql = "SELECT {$sqlParametrosSelect} FROM {$tabla}";

        if ($clausulaWhere != null) {
            $consultaSql .= " WHERE {$clausulaWhere} ";
        }

        if ($ordenSeleccion != null) {
            $consultaSql .= " ORDER BY {$ordenSeleccion} ";
        }

        if ($limit != null) {
            $consultaSql .= " LIMIT {$limit} ";
        }

        if ($offset != null) {
            $consultaSql .= " OFFSET {$offset} ";
        }

        try {
            $consultaSql = $this->dbh->prepare($consultaSql);
            $consultaSql->execute();
            $resultados = $consultaSql->fetchAll(constant('PDO::'.$tipoFetch));
            return $resultados;
        } catch (PDOException $e) {
            echo $e->getMessage();         
            return $e;
        }
    }

    public function insertIntoDB($tabla,$datos,$valoresAutonumerico = null) {
        $arrayConsultaParametros = array();
        $arrayConsultaParametrosPDO = array();
        $arrayConsultaValores = array();

        // Cargamos en un array todos los campos a insertar
        foreach($datos as $campo => $valor) {
            if (!in_array($campo, $valoresAutonumerico)) {
                array_push($arrayConsultaParametros, $campo);
                array_push($arrayConsultaParametrosPDO, ':'.$campo);
                $arrayConsultaValores[$campo] = $valor;
            }
        }

        // Preparamos la consulta
        $sqlParametros = implode(",",$arrayConsultaParametros);
        $sqlParametrosPDO = implode(",",$arrayConsultaParametrosPDO);
        $consultaSql = "INSERT INTO {$tabla} ({$sqlParametros}) VALUES ({$sqlParametrosPDO})";

        try {
            $this->dbh->prepare($consultaSql)->execute($arrayConsultaValores);
            return $this->dbh->lastInsertId();
        } catch (PDOException $e) {
            return $e;
        }
    }


    public function updateDB($tabla,$datos,$clavesPrimarias) {
        $arrayConsultaParametrosPDO = array();
        $arrayConsultaValores = array();

        // Cargamos en un array todos los campos a insertar
        foreach($datos as $campo => $valor) {
            if (!in_array($campo, $clavesPrimarias)) {
                array_push($arrayConsultaParametrosPDO, $campo.'=:'.$campo);
                $arrayConsultaValores[$campo] = $valor;
            }
        }

        // Cargamos los parámetros de la cláusula WHERE
        $arrayParametrosWhere = array();
        foreach($clavesPrimarias as $campo => $valor) {
            array_push($arrayParametrosWhere, $campo.'='.$valor);
        }

        // Preparamos la consulta
        $sqlParametrosPDO = implode(",",$arrayConsultaParametrosPDO);
        $sqlParametrosWhere = implode(" AND ",$arrayParametrosWhere);
        $consultaSql = "UPDATE {$tabla} SET {$sqlParametrosPDO} WHERE {$sqlParametrosWhere}";

        try {
            $this->dbh->prepare($consultaSql)->execute($arrayConsultaValores);
            return true;
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function deleteDB($tabla,$clavesPrimarias) {
        $arrayConsultaValores = array();

        // Cargamos los parámetros de la cláusula WHERE
        $arrayParametrosWhere = array();
        foreach($clavesPrimarias as $campo => $valor) {
            array_push($arrayParametrosWhere, $campo.'='.$valor);
        }

        // Preparamos la consulta
        $sqlParametrosWhere = implode(" AND ",$arrayParametrosWhere);
        $consultaSql = "DELETE FROM {$tabla} WHERE {$sqlParametrosWhere}";

        try {
            $this->dbh->prepare($consultaSql)->execute($arrayConsultaValores);
            return true;
        } catch (PDOException $e) {
            return $e;
        }
    }
}

?>