# PRÁCTICA 3: Servicio Canario de Salud
### El objetivo de esta práctica será aprender a trabajar con clases y objetos usando Bases de Datos

El Servicio Canario de Salud desea implementar una aplicación web que permita acceder a los
datos de los diferentes actores en el sistema. Existen los siguientes tipos de actores:
* Usuario
* Administrador
* Médico
* Enfermero
* Paciente

Para cada uno de los actores, debemos crear una clase que heredará la clase principal Usuario.

### Clase Usuario:
#### Atributos: 
* id, nombre, apellidos, email, password, fechaNacimiento, tipo
### Métodos: 
* __construct($id), __set($atributo,$valor), __get($atributo), getAtributos(),
getEdad()
### Clase Medico (hereda la clase Usuario):
* Atributos: numColegiado, centroSanitario, codigoCupo, especialidad
### Métodos:
* Reimplementar el constructor adecuadamente.
* getCentroSanitario(): Devuelve el centro sanitario en el que trabaja el médico.
* getCupo(): Devuelve el cupo en el que trabaja el médico.
* getEnfermero(): Devuelve el id del enfermero que trabaja en su cupo.
* esMiPaciente(id): Comprueba si el usuario con código id es paciente suyo o no.
Devuelve true o false.
* esMiEnfermero(id): Comprueba si el usuario con código id es enfermero de su
cupo. Devuelve true o false.

### Clase Enfermero (hereda la clase Usuario):

#### Atributos: 
* numColegiado,centroSanitario,codigoCupo
#### Métodos:
* Reimplementar el constructor adecuadamente.
* esMiPaciente(id): Comprueba si el usuario con código id es paciente suyo o no.
* esMiMedico(id): Comprueba si el usuario con código id es médico de su mismo
cupo.
* getCentroSanitario(): Devuelve el centro sanitario en el que trabaja el
enfermero.
* getMedico(): Devuelve el id del médico que trabaja en su cupo.
* getCupo(): Devuelve el cupo en el que trabaja el enfermero.

### Clase Paciente (hereda la clase Usuario):
#### Atributos: 
* numHistoria, centroSanitario, codigoCupo
#### Métodos:
* Reimplementar el constructor adecuadamente.
* getCentroSanitario(): Devuelve el centro sanitario vinculado al paciente.
* getCupo(): Devuelve el cupo al que pertenece el paciente.
* getMedico(): Devuelve el id del médico que atiende al paciente.
* getEnfermero(): Devuelve el id del enfermero que atiende al paciente.
 
### Clase Cita:
#### Atributos: 
* id, fechaHora, idPaciente, tipo
* El atributo tipo se refiere a si se trata de una cita médica o de una cita de
enfermería.

Cuando un usuario accede al sistema, se deberá mostrar una página y un menú acorde al tipo
de usuario que ha accedido. Además, cada usuario sólo podrá acceder a aquellos datos que
tenga permitido.
### Administrador
* Menú: Inicio | Usuarios | Médicos | Enfermeros | Pacientes | Citas
* Datos: Puede acceder a todos los datos que desee
### Médico
* Menú: Inicio | Enfermeros | Pacientes | Citas
* Datos: Puede acceder al listado de enfermeros asignados a su cupo, al listado de
pacientes asignados a su cupo y al listado de citas de pacientes de su cupo (tanto citas
médicas como de enfermería). El resto de datos no serán accesibles, mostrando un
mensaje de error.
### Enfermero
* Menú: Inicio | Médicos | Pacientes | Citas
* Datos: Puede acceder al listado de médicos asignados a su cupo, al listado de pacientes
asignados a su cupo y al listado de citas de pacientes de su cupo (sólo citas de
enfermería). El resto de datos no serán accesibles, mostrando un mensaje de error.
### Paciente
* Menú: Inicio | Médicos | Citas
* Datos: Puede acceder al listado de médicos asignados a su cupo y al listado de citas
propias, tanto de enfermería como de medicina. El resto de datos no serán accesibles,
mostrando un mensaje de error.

La aplicación dispondrá de una página fichaUsuario.php que gestionará diferentes plantillas
(fichaMedico.html, fichaEnfermero.html…) en la que se mostrarán los datos de un usuario en
concreto. Siempre garantizando que el usuario puede acceder a los datos que se pretenden
mostrar.

Por último, también existirá una página fichaCita.php que mostrará todos los detalles de la cita
que tenga el paciente: fecha/hora, nombre del sanitario (médico o enfermero), tipo de cita
(medicina o enfermería) y centro sanitario.

Además, añadiremos la funcionalidad de que el paciente pueda crear (solicitar) una nueva cita
médica o de enfermería o eliminar una ya existente.
