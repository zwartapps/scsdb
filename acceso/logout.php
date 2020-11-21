<?php
require_once("cargarSesion.php");
require_once("../globales.php");

session_unset();
session_destroy();

header('Location: '.$GLOBALES['rutaPrincipal'].'/index.php');
?>