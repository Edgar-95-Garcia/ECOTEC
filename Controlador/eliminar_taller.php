<?php
$GLOBALS['menu'] = 'administrar_talleres';

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["admin_ecotec"]) == null) {
?>
    <script>
        document.location.replace("../index.php");
    </script>
    <?php
    /* 
      id=<?php echo ($d["ID_TALLER"])
      &p=<?php echo ($_SESSION["ID"])
      &id_f=<?php echo $foto['ID_FOTO']
      &u=<?php echo ($_SESSION["user"])
    */

} else if (isset($_GET["id"]) && isset($_GET["u"])) {
    include_once("../Controlador/key.php");
    $k = new key();
    $id = $_GET["id"]; //id taller
    $sesion = $k->dec($_GET["u"]); //id de sesión
    if ($_SESSION["admin_ecotec"] == $sesion) {
        //primero se borra toda la información del taller
        include_once("../Modelo/Talleres/Borrar_taller.php");
        $obj_taller = new Borrar_taller();
        if ($obj_taller->deleteTaller($id) == 1) {
            //se borra toda la información sobre las fotos guardadas del taller eliminado
            include_once("../Modelo/Fotos/Borrar_foto.php");
            $obj_fotos = new Borrar_foto();
            if ($obj_fotos->deleteFotosFromIdTaller($id) == 1) {
                //se eliminan todos los alumnos registrados a dicho taller
                include_once("../Modelo/TalleresAlumnos/Borrar_taller_alumno.php");
                $obj_taller_alumnos = new Borrar_taller_alumno();
                if ($obj_taller_alumnos->deleteTallerAlumnosByIdTaller($id) == 1) {
                    echo '<script type="text/javascript">alert("Taller y toda su información eliminada satisfactoriamente");</script>';
                } else {
                    echo '<script type="text/javascript">alert("Taller y fotos borradas satisfactoriamente, pero lista de alumnos inscritos no. Consultar con soporte");</script>';
                }
            } else {
                echo '<script type="text/javascript">alert("Taller borrado satisfactoriamente, pero fotos no. Consultar con soporte");</script>';
            }
        } else {
            echo '<script type="text/javascript">alert("Taller no ha sido borrado, reintente en unos minutos");</script>';
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