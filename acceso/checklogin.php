<?php
require_once("cargarSesion.php");
require_once("../globales.php");
require_once('../class/class.TokenGenerator.php');
require_once("../class/class.Usuario.php");
require_once("../class/class.Rol.php");

if (isset($_SESSION[CAMPO_DATOS_SESION])) {
    // Si ya existe una sesión anterior, la destruimos
    session_unset();
    session_destroy();
}

$usuario = new Usuario(0,$_POST['usuario']);
$checkPassword = $usuario->checkPassword($_POST['password']);

if($checkPassword) {
    if($usuario->bloqueado == 0){
        // Abrimos la sesión del usuario    
        $token = new TokenGenerator();
        $data = array(
            'id' => $usuario->id,
            'email' => $usuario->email
        );
        $datosCifrados = $token->generateToken($data);
        
        $_SESSION[CAMPO_DATOS_SESION] = $datosCifrados;
        
        // Redirigimos al usuario al índice correspondiente
        $rol = new Rol($usuario->idRol);
        header('Location: '.$GLOBALES["rutaPrincipal"].'/'.$rol->indexWeb);
    } else {
         header('Location: '.$GLOBALES["rutaPrincipal"].'/acceso/bloqueado.php');         
    }
} else {
    $usuario->numIntentosLogin++;
    if($usuario->numIntentosLogin >= $GLOBALES['maxNumIntentosLogIn']){
        $usuario->bloqueado = 1;
    }
    $usuario->guardar();
    header('Location: '.$GLOBALES["rutaPrincipal"].'/acceso/login.php');
}

?>