<?php
$GLOBALS['menu'] = 'admon';
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["admin_ecotec"]) == null) {
?>
    <script>
        document.location.replace("../index.php");
    </script>
    <?php

} else if (isset($_GET["id"]) && isset($_GET["u"]) && isset($_GET["t"])) {
    include_once("../Controlador/key.php");
    $k = new key();
    $id = $_GET["id"]; //id alumno
    $id_taller = $_GET["t"];
    $sesion = $k->dec($_GET["u"]); //id sesion
    if ($_SESSION["admin_ecotec"] == $sesion) {
        include_once("../Modelo/TalleresAlumnos/Borrar_taller_alumno.php");
        $obj_taller_alumno = new Borrar_taller_alumno();
        if ($obj_taller_alumno->deleteTallerAlumnoByIdAlumno($id,$id_taller) == 1) {
            //se eliminó usuario de taller, se procede a actualizar lugares disponibles de dicho taller
            include_once("../Modelo/Talleres/Modificar_taller.php");
            $obj_modificar_taller = new Modificar_taller();
            if ($obj_modificar_taller->updateTallerLugaresAumenta($id_taller) == 1) {
                echo '<script type="text/javascript">alert("Alumno borrado de taller satisfactoriamente");</script>';
            } else {
                echo '<script type="text/javascript">alert("Alumno borrado de taller, pero taller no se actualizó, revisar con equipo de sistemas");</script>';
            }
        } else {
            echo '<script type="text/javascript">alert("Alumno no ha sido borrado, reintente en unos minutos");</script>';
        }
    ?>
        <script>
            document.location.replace("../admon_administrar_talleres.php");
        </script>
    <?php
    } else {
    ?>
        <script>
            document.location.replace("../index.php");
        </script>
    <?php
    }
} else {
    ?>
    <script>
        document.location.replace("../index.php");
    </script>
<?php
}
?>