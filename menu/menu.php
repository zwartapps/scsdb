<nav  id="menu-admin" class="navbar navbar-expand-md">
    <a class="navbar-brand" href="<?php echo $GLOBALES['rutaPrincipal']?>/index.php"><img class="imagenLogoMenuSuperior" src="<?php echo $GLOBALES['rutaPrincipal']?>/img/logo_scs.svg" height="80" alt="Inicio"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">

            <li id="menu-home" class="nav-item">
                <a class="nav-link" href="<?php echo $GLOBALES['rutaPrincipal']?>/index.php"><i class="fa fa-home fa-3x" aria-hidden="true"></i><br>Inicio</a>
            </li>

            <li id="menu-imc" class="nav-item">
                <a class="nav-link" href="<?php echo $GLOBALES['rutaPrincipal']?>/imc.php"><i class="fas fa-calculator fa-3x"></i><br>IMC</a>
            </li>
            <li id="menu-check-email" class="nav-item">
                <a class="nav-link" href="<?php echo $GLOBALES['rutaPrincipal']?>/checkEmail.php"><i class="fas fa-check-double fa-3x"></i><br>Check Email</a>
            </li>
            <li id="menu-conversor-moneda" class="nav-item">
                <a class="nav-link" href="<?php echo $GLOBALES['rutaPrincipal']?>/conversorMoneda.php"><i class="fas fa-euro-sign fa-3x"></i><br>Conversor</a>
            </li>
            <!--
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="javascript:void(0)">Action</a>
                    <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                    <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0)">Separated link</a>
                </div>
            </li>
            -->
        </ul>

        <ul class="navbar-nav ml-auto">
            <li id="menu-home" class="nav-item">
                <a class="nav-link" href="<?php echo $GLOBALES['rutaPrincipal']?>/usuarios/logout.php"><i class="fas fa-sign-out-alt fa-3x"></i><br>Salir</a>
            </li>
        </ul>

    </div>
</nav>