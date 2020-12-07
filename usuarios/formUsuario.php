<?php
require_once("../globales.php");
require_once("../acceso/cargarSesion.php");
require_once("../acceso/comprobarLogIn.php");
require_once("../class/class.Usuario.php");
require_once("../class/class.Rol.php");
require_once("../class/class.PermisosWeb.php");

// Cargamos el usuario
$usuario = new Usuario($GLOBAL_SESSION[CAMPO_DATOS_SESION]['id']);

// Cargamos los datos del Rol
$rol = new Rol($usuario->idRol);

// Comprobamos si puede estar aquí
$nombrePaginaActual = basename(__FILE__);
$permisosWeb = new PermisosWeb($usuario->idRol, $nombrePaginaActual);

if (!$permisosWeb->permitido) {
    exit;
}

// Primero comprobamos si se trata de la edición de un usuario existente
if (isset($_GET['id'])) {
    // Cargamos los datos del usuario a editar
    $id = $_GET['id'];
    $usuario = new Usuario($id);
	$rol = new Rol($usuario->idRol);
	
	header('Location: '.$GLOBALES["rutaPrincipal"].'/usuarios/'.$rol->plantillaForm.'?id='.$id);
}


?>