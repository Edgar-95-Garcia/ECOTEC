<?php
$GLOBALS['menu'] = 'administrar_talleres';

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["admin"]) == null) {
?>
    <script>
        document.location.replace("../administrar_talleres.php");
    </script>
    <?php
    /* 
      id=<?php echo ($d["ID_TALLER"])
      &p=<?php echo ($_SESSION["ID"])
      &id_f=<?php echo $foto['ID_FOTO']
      &u=<?php echo ($_SESSION["user"])
    */

} else if (isset($_GET["id"]) && isset($_GET["u"]) && isset($_GET["p"]) && isset($_GET["id_f"])) {
    $id = $_GET["id"]; //id taller
    $p = $_GET["p"]; //id profesor
    $sesion = $_GET["u"]; //id_sesion
    $id_foto = $_GET["id_f"];
    if ($_SESSION["ID"] == $p && $_SESSION["user"] == $sesion) {

        include_once("../Modelo/Fotos/Borrar_foto.php");
        $obj_fotos = new Borrar_foto();
        if ($obj_fotos->deleteFotoFromIdTallerIdFoto($id, $id_foto) == 1) {
            echo '<script type="text/javascript">alert("Foto borrada satisfactoriamente");</script>';
        } else {
            echo '<script type="text/javascript">alert("Foto no ha sido borrada, reintente en unos minutos");</script>';
        }
    ?>
        <script>
            document.location.replace("../administrar_talleres.php");
        </script>
    <?php
    } else {
    ?>
        <script>
            document.location.replace("../administrar_talleres.php");
        </script>
<?php
    }
}
?>