<?php
date_default_timezone_set("America/Mexico_City");
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($GLOBALS['menu'])) {
    $GLOBALS['menu'] = 'index';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTec</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="./Static/CSS/style.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- /-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/js/bootstrap-colorpicker.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/js/bootstrap-colorpicker.min.js"> </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/css/bootstrap-colorpicker.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/css/bootstrap-colorpicker.css" />

    <!-- /-->
</head>

<body>
    <?php
    include_once("./Controlador/key.php");
    $k = new key();
    include_once("./Modelo/Apariencia/Consultar_apariencia.php");
    $obj_apariencia = new Consultar_apariencia();
    $datos_apariencia = $obj_apariencia->selectApariencia();
    foreach ($datos_apariencia as $datos) {
        if ($datos['TIPO'] == "lOaWBJSTUDhn") {
            $color_menu = $datos['VALOR'];
        }
        if ($datos['TIPO'] == "lOaWBJSKUC5mfHT2Wnw=") {
            $color_menu_texto = $datos['VALOR'];
        }
        if ($datos['TIPO'] == "lOaWBJSYWjh2fGrmRGzkW7st") {
            $color_menu_fondo_superior = $datos['VALOR'];
        }
    }
    ?>
    <div style="background-color: <?php echo $k->dec($color_menu_fondo_superior) ?>">
        <center><img src="./Static/images/logo.jpg" width="400" height="150"></center>
    </div>
    <nav class="navbar navbar-expand-lg sticky-top navbar-dark" aling="center" style="background-color:<?php echo $k->dec($color_menu) ?>; font-size:large;font-family:Cooper Black">
        <a class="navbar-brand" href="./index.php"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#colNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="colNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if ($GLOBALS['menu'] == 'index') echo 'active'; ?>">
                    <a class="nav-link" aling="center" href="./index.php">INICIO</a>
                </li>
                <li class="nav-item <?php if ($GLOBALS['menu'] == 'BOLSA DE TRABAJO') echo 'active'; ?>">
                    <a class="nav-link" aling="center" href="./bolsatrabajo.php">BOLSA DE TRABAJO</a>
                </li>
                <?php
                if (isset($_SESSION["user"]) || isset($_SESSION["admin"])) {
                ?>
                    <li class="nav-item <?php if ($GLOBALS['menu'] == 'talleres/horarios') echo 'active'; ?>">
                        <a class="nav-link" aling="center" href="./alumnos_talleres.php">TALLERES DISPONIBLES</a>
                    </li>
                <?php
                }
                if (isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
                ?>
                    <li class="nav-item <?php if ($GLOBALS['menu'] == 'talleres_registrados') echo 'active'; ?>">
                        <a class="nav-link" aling="center" href="./alumnos_talleres_registrados.php">TALLERES REGISTRADOS</a>
                    </li>
                <?php
                }
                if (isset($_SESSION["admin"])) {
                ?>
                    <li class="nav-item <?php if ($GLOBALS['menu'] == 'administrar_talleres') echo 'active'; ?>">
                        <a class="nav-link" aling="center" href="./administrar_talleres.php">ADMINISTRAR TALLERES</a>
                    </li>
                <?php
                }
                ?>
                <?php
                if (isset($_SESSION["admin_ecotec"])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" aling="center" href="./RIDEECOTEC.php">RIDEECOTEC</a>
                    </li>
                <?php
                }
                ?>
                <li class="nav-item <?php if ($GLOBALS['menu'] == 'ENTRAR') echo 'active'; ?>">
                    <?php
                    if (!isset($_SESSION["user"])  && !isset($_SESSION["admin_ecotec"])) {
                        echo '<a class="nav-link" href="./login.php">ENTRAR</a>';
                    }
                    ?>
                </li>
                <li class="nav-item <?php if ($GLOBALS['menu'] == 'registro') echo 'active'; ?>">
                    <?php
                    if (!isset($_SESSION["user"]) && !isset($_SESSION["admin_ecotec"])) {
                        echo '<a class="nav-link" href="./register.php">REGISTRARSE</a>';
                    }
                    ?>
                </li>
                <?php
                if (isset($_SESSION["admin_ecotec"])) {
                ?>
                    <li class="nav-item dropdown <?php if ($GLOBALS['menu'] == 'admon') echo 'active'; ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ADMINISTRACIÓN
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" aling="center" href="./admon_administrar_profesores.php">ADMINISTRAR PROFESORES</a>
                            <a class="dropdown-item" aling="center" href="./admon_administrar_alumnos.php">ADMINISTRAR ALUMNOS</a>
                            <a class="dropdown-item" aling="center" href="./admon_administrar_talleres.php">ADMINISTRAR TALLERES</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown <?php if ($GLOBALS['menu'] == 'prson') echo 'active'; ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            PERSONALIZACIÓN
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" aling="center" href="./admon_administrar_superusuario_modificar.php">SUPERUSUARIO</a>
                            <a class="dropdown-item" aling="center" href="./admon_administrar_pass.php">CONTRASEÑA DE REGISTRO</a>
                            <a class="dropdown-item" aling="center" href="./admon_administrar_noticias_panel.php">PANEL DE NOTICIAS</a>
                            <a class="dropdown-item" aling="center" href="./admon_administrar_noticias.php">BANNER DE NOTICIAS</a>
                            <a class="dropdown-item" aling="center" href="./admon_administrar_apariencia.php">APARIENCIA DE PÁGINA</a>
                        </div>
                    </li>
                <?php
                }
                ?>
                <li>
                    <?php
                    if (isset($_SESSION["user"])  || isset($_SESSION["admin_ecotec"])) {
                        echo '<a class="nav-link" href="index.php?t=0">CERRAR SESIÓN</a>';
                    }
                    ?>
                </li>

                <li>
                    <?php
                    if (isset($_SESSION["user"])) {
                        echo '<a class="nav-link">BIENVENIDO ' . $_SESSION['nombre'] . '</a>';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>