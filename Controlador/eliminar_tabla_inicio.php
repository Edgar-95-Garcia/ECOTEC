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
        include_once("../Modelo/TablaInicio/Borrar_tabla_inicio.php");
        $obj_usuario = new Borrar_tabla_inicio();
        if ($obj_usuario->deleteTablaInicio($id) == 1) {
            echo '<script type="text/javascript">alert("Registro borrado satisfactoriamente");</script>';
        } else {
            echo '<script type="text/javascript">alert("Registro no ha sido borrado, reintente en unos minutos");</script>';
        }
    ?>
        <script>
            document.location.replace("../admon_administrar_tabla_inicio.php");
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