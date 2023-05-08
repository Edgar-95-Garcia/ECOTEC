<?php
$GLOBALS['menu'] = 'prson';
include_once("./cabecera.php");
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
?>

    <div class="card text-center" style="width:50%;height:100%; position:relative;left:25%">
        <div class="card-body">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <font size="6" face="Cooper Black" color="#3CA43C">
                        <h5 class="card-header">Formulario de registro de imagen para el panel del inicio </h5>
                    </font>
                    <div class="card-body">
                        <font size="4" face="Constantia" color="#3CA43C">
                            <p class="card-text">
                            <div class="form-group">
                                <label for="FILE">Agrega una imagen/foto que se va a mostrar a un lado del banner <i>La foto no debe de pesar más de 3 Megabytes</i><br><i>La imágen debe tener una relación de 640 x 360 pixeles o proporcional, de lo contrarió se mostrará como una imágen estirada</i></label>
                                <input type="file" class="form-control-file" id="FILE" name="img">
                            </div>
                            <?php include("./Controlador/registro_noticia_panel.php"); ?>
                            <input type="submit" class="btn btn-success" style="width: 60%;" value="REGISTRAR" name="registrar_banner_imagen">
                            <br></br>
                            <a href="./admon_administrar_noticias_panel.php"> <input class="btn btn-success" style="width: 60%;" type="button" value="REGRESAR"></a>
                    </div>
                </div>
                <br>
            </form>
        </div>
    </div>
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