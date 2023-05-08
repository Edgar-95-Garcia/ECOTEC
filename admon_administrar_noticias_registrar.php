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
                        <h5 class="card-header">Formulario de registro de banner de noticia </h5>
                    </font>
                    <div class="card-body">
                        <font size="4" face="Constantia" color="#3CA43C">
                            <p class="card-text">
                            <div class="form-group">
                                <label for="FILE">Agrega una imagen/foto que se va a mostrar a un lado del banner <i>La foto no debe de pesar más de 3 Megabytes</i></label>
                                <input type="file" class="form-control-file" id="FILE" name="img">
                            </div>
                            <hr>
                            TITULO DEL BANNER<br><i>Ingresa el titulo que se va a mostrar en el banner</i><br><br>
                            <input name="titulo" type="text" placeholder=""> <br><br>
                            TEXTO DEL BANNER <br><i>Ingresa el texto que se va a mostrar en el banner</i><br><br>
                            <textarea class="form-control" id="textArea" name="textArea" rows="3"></textarea><br><br>
                            <?php include("./Controlador/registro_noticia.php"); ?>
                            <input type="submit" class="btn btn-success" style="width: 60%;" value="REGISTRAR" name="registrar_banner">
                            <br></br>
                            <a href="./admon_administrar_noticias.php"> <input class="btn btn-success" style="width: 60%;" type="button" value="REGRESAR"></a>
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