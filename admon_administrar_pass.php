<?php
$GLOBALS['menu'] = 'prson';

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["admin_ecotec"]) == null) {
?>
    <script>
        window.location.replace("index.php");
    </script>
<?php
} else if (isset($_SESSION["admin_ecotec"]) == "ecotec") {
    include_once("./cabecera.php");
    include_once("./Controlador/key.php");
    $k = new key();
    include_once("./Modelo/Usuarios/Consultar_usuario.php");
    $obj_superusuario = new Consultar_usuario();
    $datos_superusuario = $obj_superusuario->selectUsersAdmin();
    include_once("./Modelo/Config/Consultar_config.php");
    $obj_config = new Consultar_config();
    $datos_config = $obj_config->select_config();    ?>
    <div class="card text-center" style="height:100%; position:relative;left:0%">
        <div class="card-body">
            <h5 class="card-title">FORMULARIO PARA MODIFICAR LAS NOTICIAS</strong></h5>
            <p class="card-text">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <?php foreach ($datos_config as $config) { ?>
                    CONTRASEÑA<br><i>Con esta contraseña los profesores se pueden registrar en el sistema y tener los privilegios para crear y actualizar talleres<br>Cuando se cambie se tiene que dar a los nuevos profesores que se quieran registrar en el sistema</i><br><br>
                    <input name="pass" type="text" value="<?php echo $k->dec($config['sOtAIxclbMs=']) ?>"> <br><br>
                    <?php include("./Controlador/modificar_config.php"); ?>
                    <br><br>
                    <input type="submit" class="btn btn-success" style="width: 60%;" value="ACTUALIZAR" name="modificar_pass">
                    <br></br>
                <?php } ?>
            </form>
        </div>
    </div>
    <br><br>
<?php
    include_once("./pie.php");
} else {
?>
    <script>
        window.location.replace("index.php");
    </script>
<?php
}

?>