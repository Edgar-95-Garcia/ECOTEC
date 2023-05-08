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
            <h5 class="card-title">FORMULARIO PARA MODIFICAR SUPER USUARIO</strong></h5>
            <p class="card-text">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <?php foreach ($datos_superusuario as $super_usuario) { ?>
                    <input type="hidden" name="id_super_usuario" value="<?php echo ($super_usuario['ID_USUARIO']) ?>">
                    CORREO<br><br><input name="correo" type="text" value="<?php echo $k->dec($super_usuario['CORREO']) ?>"> <br><br>
                    CONTRASEÑA<br><br><input name="password" type="text" value="<?php echo $k->dec($super_usuario['PASS']) ?>"> <br><br>
                    <?php include("./Controlador/modificar_super_usuarios.php"); ?>
                    <br><br>
                    <input type="submit" class="btn btn-success" style="width: 60%;" value="ACTUALIZAR" name="modificar_super_usuario">
                    <br></br>
                <?php } ?>
            </form>
            </p>
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