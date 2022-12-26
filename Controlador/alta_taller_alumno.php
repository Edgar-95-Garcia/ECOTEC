<?php
$GLOBALS['menu'] = 'talleres/horarios';

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["user"]) == null) {
?>
    <script>
        document.location.replace("./alumnos_talleres.php");
    </script>
<?php
} else if (isset($_GET["id"]) && isset($_GET["a"])) {
    $id = $_GET["id"]; //id taller
    $p = $_GET["a"]; //id alumno


    include_once("../Modelo/TalleresAlumnos/Insertar_taller_alumno.php");
    $obj_taller_alumno = new Insertar_taller_alumno();

    if ($obj_taller_alumno->add_taller_alumno($p, $id) == 1) {
        echo '<script type="text/javascript">alert("Taller asignado satisfactoriamente");</script>';
    } else {
        echo '<script type="text/javascript">alert("Taller no asignado, reintente en unos minutos");</script>';
    }
?>
    <script>
        document.location.replace("../alumnos_talleres.php");
    </script>
<?php

}
?>