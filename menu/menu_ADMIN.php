<nav  id="menu-admin" class="navbar navbar-expand-md">
    <a class="navbar-brand" href="<?php echo $GLOBALES['rutaPrincipal']?>/index_ADMIN.php"><img class="imagenLogoMenuSuperior" src="<?php echo $GLOBALES['rutaPrincipal']?>/img/logo_scs.svg" height="80" alt="Inicio"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">

            <li id="menu-home" class="nav-item">
                <a class="nav-link" href="<?php echo $GLOBALES['rutaPrincipal']?>/index_ADMIN.php"><i class="fa fa-home fa-3x" aria-hidden="true"></i><br>Inicio</a>
            </li>
            <li id="menu-usuarios" class="nav-item">
                <a class="nav-link" href="<?php echo $GLOBALES['rutaPrincipal']?>/usuarios/usuarios.php"><i class="fas fa-users fa-3x"></i><br>Usuarios</a>
            </li>
            <li id="menu-medicos" class="nav-item">
                <a class="nav-link" href="<?php echo $GLOBALES['rutaPrincipal']?>/usuarios/medicos.php"><i class="fas fa-user-md fa-3x"></i><br>Médicos</a>
            </li>
            <li id="menu-enfermeros" class="nav-item">
                <a class="nav-link" href="<?php echo $GLOBALES['rutaPrincipal']?>/usuarios/enfermeros.php"><i class="fas fa-user-nurse fa-3x"></i><br>Enfermeros</a>
            </li>
            <li id="menu-pacientes" class="nav-item">
                <a class="nav-link" href="<?php echo $GLOBALES['rutaPrincipal']?>/usuarios/pacientes.php"><i class="fas fa-user-injured fa-3x"></i><br>Pacientes</a>
            </li>
            <li id="menu-citas" class="nav-item">
                <a class="nav-link" href="<?php echo $GLOBALES['rutaPrincipal']?>/citas/citas.php"><i class="fas fa-calendar fa-3x"></i><br>Citas</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li id="menu-home" class="nav-item">
                <a class="nav-link" href="<?php echo $GLOBALES['rutaPrincipal']?>/acceso/logout.php"><i class="fas fa-sign-out-alt fa-3x"></i><br>Salir</a>
            </li>
        </ul>

    </div>
</nav>