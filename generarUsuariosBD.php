<?php
require_once './class/class.Usuario.php';
require_once './class/class.Rol.php';
require_once './db/class.GestorDB.php';

$nombres = array('Juan', 'Pedro', 'Andrés', 'Jorge', 'Marcos', 'Rubén', 'Raquel', 'María', 'Rocío', 'Beatriz', 'Teresa', 'Rita');
$apellidos1 = array('Hernández', 'Rodríguez', 'Cruz', 'Adán', 'Díaz', 'Soto', 'Marichal', 'Modino', 'Gil', 'Ravelo', 'Dorta', 'Domínguez');
$apellidos2 = array('Brito', 'Fernández', 'Mesa', 'González', 'Castillo', 'Guanche', 'Molina', 'García', 'Estévez', 'Pérez', 'Alonso', 'Barreto');

$calles = array('Porlier', 'Costa y Grijalba', 'Calvo Sotelo', 'Ánguel Guimerá', 'Puerta Canseco', 'José Hernández Alfonso', 'Castro', 'San Antonio', 'Méndez Núñez', 'General Gutiérrez');


// Creamos los usuarios administradores
for ($i = 1; $i <= 3; $i++) {
    $usuarioPrueba = new Usuario();
    $usuarioPrueba->idRol = 1;
    $usuarioPrueba->nombre = $nombres[rand(0,11)];
    $usuarioPrueba->apellidos = $apellidos1[rand(0,11)]." ".$apellidos2[rand(0,11)];
    $usuarioPrueba->email = 'administrador'.$i.'@pruebas.com';
    $usuarioPrueba->setPassword('Probando');
    $usuarioPrueba->fechaNacimiento = rand(1970,1990).'-'.rand(1,12).'-'.rand(1,28);
    $usuarioPrueba->direccion = 'Calle '.$calles[rand(0,9)].', '.rand(1,50);
    $usuarioPrueba->cp = '380'.rand(0,9).rand(0,9);
    $usuarioPrueba->numIntentosLogin = '0';
    $usuarioPrueba->ultimoAcceso = '2020-11-01  16:00:00';
    $usuarioPrueba->bloqueado = '0';

    $usuarioPrueba->guardar();
}


// Creamos los usuarios médicos
for ($i = 1; $i <= 10; $i++) {
    $usuarioPrueba = new Usuario();
    $usuarioPrueba->idRol = 2;
    $usuarioPrueba->nombre = $nombres[rand(0,11)];
    $usuarioPrueba->apellidos = $apellidos1[rand(0,11)]." ".$apellidos2[rand(0,11)];
    $usuarioPrueba->email = 'medico'.$i.'@pruebas.com';
    $usuarioPrueba->setPassword('Probando');
    $usuarioPrueba->fechaNacimiento = rand(1965,1985).'-'.rand(1,12).'-'.rand(1,28);
    $usuarioPrueba->direccion = 'Calle '.$calles[rand(0,9)].', '.rand(1,50);
    $usuarioPrueba->cp = '380'.rand(0,9).rand(0,9);
    $usuarioPrueba->numIntentosLogin = '0';
    $usuarioPrueba->ultimoAcceso = '2020-11-01  16:00:00';
    $usuarioPrueba->bloqueado = '0';

    $usuarioPrueba->guardar();
}

// Creamos los usuarios enfermeros
for ($i = 1; $i <= 10; $i++) {
    $usuarioPrueba = new Usuario();
    $usuarioPrueba->idRol = 3;
    $usuarioPrueba->nombre = $nombres[rand(0,11)];
    $usuarioPrueba->apellidos = $apellidos1[rand(0,11)]." ".$apellidos2[rand(0,11)];
    $usuarioPrueba->email = 'enfermero'.$i.'@pruebas.com';
    $usuarioPrueba->setPassword('Probando');
    $usuarioPrueba->fechaNacimiento = rand(1965,1990).'-'.rand(1,12).'-'.rand(1,28);
    $usuarioPrueba->direccion = 'Calle '.$calles[rand(0,9)].', '.rand(1,50);
    $usuarioPrueba->cp = '380'.rand(0,9).rand(0,9);
    $usuarioPrueba->numIntentosLogin = '0';
    $usuarioPrueba->ultimoAcceso = '2020-11-01  16:00:00';
    $usuarioPrueba->bloqueado = '0';

    $usuarioPrueba->guardar();
}

// Creamos los usuarios pacientes
for ($i = 1; $i <= 100; $i++) {
    $usuarioPrueba = new Usuario();
    $usuarioPrueba->idRol = 4;
    $usuarioPrueba->nombre = $nombres[rand(0,11)];
    $usuarioPrueba->apellidos = $apellidos1[rand(0,11)]." ".$apellidos2[rand(0,11)];
    $usuarioPrueba->email = 'paciente'.$i.'@pruebas.com';
    $usuarioPrueba->setPassword('Probando');
    $usuarioPrueba->fechaNacimiento = rand(1935,1990).'-'.rand(1,12).'-'.rand(1,28);
    $usuarioPrueba->direccion = 'Calle '.$calles[rand(0,9)].', '.rand(1,50);
    $usuarioPrueba->cp = '380'.rand(0,9).rand(0,9);
    $usuarioPrueba->numIntentosLogin = '0';
    $usuarioPrueba->ultimoAcceso = '2020-11-01  16:00:00';
    $usuarioPrueba->bloqueado = '0';

    $usuarioPrueba->guardar();
}

?>
