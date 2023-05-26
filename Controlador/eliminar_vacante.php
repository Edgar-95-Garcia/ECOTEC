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
} else if (isset($_GET["id"]) && isset($_GET["u"])) {
    include_once("../Controlador/key.php");
    $k = new key();
    $id = $_GET["id"]; //id vacante
    $sesion = $k->dec($_GET["u"]); //id_sesion
    if ($_SESSION["admin_ecotec"] == $sesion) {
        include_once("../Modelo/Trabajo/Borrar_trabajo.php");
        $obj_anuncio = new Borrar_trabajo();
        if ($obj_anuncio->deleteAnuncio($id) == 1) {
            echo '<script type="text/javascript">alert("Anuncio borrado satisfactoriamente");</script>';
        } else {
            echo '<script type="text/javascript">alert("Anuncio no ha sido borrado, reintente en unos minutos");</script>';
        }
        ?>
            <script>
                document.location.replace("../admon_administrar_bolsa_trabajo.php");
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