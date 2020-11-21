<?php
require_once("cargarSesion.php");
require_once("../globales.php");

if (isset($_SESSION['nombreUsuario'])) {
    header('Location: '.$GLOBALES["rutaPrincipal"].'/index.php');
    exit;
} else {
    $menuACargar = "../menu/menu-notlog.php";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Pruebas PHP - CIP</title>
    <meta charset="UTF-8">
    <meta name="title" content="Prueba de formularios PHP">
    <meta name="description" content="Web con diferentes formularios para hacer pruebas con PHP">
    <?php include("../lib/header.php"); ?>
</head>


<body>
<!-- Incluimos el menú de navegación -->
<?php include($menuACargar); ?>

<!-- Activamos la sección del menú -->
<script>$("#menu-home").addClass('active')</script>


<section class="mt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card bg-light border-warning mb-3">
                    <div class="card-header text-secondary font-weight-bold"><i class="fas fa-sign-in-alt"></i> Log In</div>
                    <div class="card-body">
                        <h3 class="card-title text-center text-warning"><i class="fas fa-sign-in-alt fa-3x"></i></h3>
                        <p class="card-text text-info text-justify">Introduzca su nombre de usuario y contraseña para acceder</p>
                        <form action="checklogin.php" method="post">
                            <div class="form-row align-items-center">
                                <div class="col-md-6">
                                    <label class="sr-only" for="inputEstatura">Usuario</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="inputUsuario" name="usuario" placeholder="Introduzca aquí su usuario">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row align-items-center">
                                <div class="col-md-6">
                                    <label class="sr-only" for="inputEstatura">Password</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-key"></i></div>
                                        </div>
                                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Introduzca aquí su contraseña">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success mb-2"><i class="fas fa-sign-in-alt"></i> Acceder</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>

<footer class="footer">
    <!-- Incluimos el menú de navegación -->
    <?php include("../footer.php"); ?>
</footer>
</body>
</html>