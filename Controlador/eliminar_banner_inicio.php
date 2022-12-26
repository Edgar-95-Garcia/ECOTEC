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
    $id = $_GET["id"]; //id banner
    $sesion = $k->dec($_GET["u"]); //id_sesion
    if ($_SESSION["admin_ecotec"] == $sesion) {
        include_once("../Modelo/Inicio/Borrar_inicio.php");
        $obj_usuario = new Borrar_inicio();
        if ($obj_usuario->deleteBanner($id) == 1) {
            echo '<script type="text/javascript">alert("Banner de noticia borrado satisfactoriamente");</script>';
        } else {
            echo '<script type="text/javascript">alert("Banner de noticia no ha sido borrado, reintente en unos minutos");</script>';
        }
    ?>
        <script>
            document.location.replace("../admon_administrar_noticias.php");
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