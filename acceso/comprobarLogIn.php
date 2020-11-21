<?php
require_once(__DIR__.'/../class/class.TokenGenerator.php');
if (!isset($_SESSION[CAMPO_DATOS_SESION])) {
    header('Location: '.$GLOBALES["rutaPrincipal"].'/acceso/login.php');
    exit;
}

$GLOBAL_SESSION = array();
$token = new TokenGenerator();

try {
    $decodificado = $token->decodeToken($_SESSION[CAMPO_DATOS_SESION]);
} catch (\Exception $e) {
    print_r($e);
}

$GLOBAL_SESSION[CAMPO_DATOS_SESION] = $decodificado;

?>