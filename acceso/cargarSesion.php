<?php
require_once __DIR__.'/../globales.php';

session_name(NOMBRE_SESION);
session_start();
session_regenerate_id();
?>