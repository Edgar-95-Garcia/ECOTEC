<?php
$GLOBALS['menu'] = 'administrar_talleres';

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["admin"]) == null) {
?>
    <script>
        window.location.replace("index.php");
    </script>
    <?php
} else if (isset($_GET["id"]) && isset($_GET["u"]) && isset($_GET["p"])) {
    $id = $_GET["id"]; //id taller
    $p = $_GET["p"]; //id profesor
    $sesion = $_GET["u"];
    if ($_SESSION["ID"] == $p && $_SESSION["user"] == $sesion) {
        include_once("./cabecera.php");
    ?>

        <div class="card text-center" style="width:50%;height:100%; position:relative;left:25%">
            <br>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <!------------------------------------------------------------------------------------------->
                        <?php
                        include_once("./Modelo/Talleres/Consultar_taller.php");
                        $obj_talleres = new Consultar_taller();
                        $datos = $obj_talleres->selectTallerFromIdProfesor($id, $p);
                        include_once("./Controlador/key.php");
                        $k = new key();
                        ?>
                        <?php
                        foreach ($datos as $d) {
                        ?>

                            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                <div class="card">
                                    <font size="6" face="Cooper Black" color="#3CA43C">
                                        <?php include_once("./Controlador/key.php");
                                        $k = new key();?>
                                        
                                        <h5 class="card-header">Formulario para agregar fotos al taller</h5>
                                    </font>
                                    <div class="card-body">
                                        <font size="4" face="Constantia" color="#3CA43C">
                                            <p class="card-text">
                                            <p>Ingresar fotos al taller hace más atractivo el mismo. <br> Agrega fotos sobre productos obtenidos, prácticas, actividades o cualquier foto relacionada al taller</p><br>
                                            <i>La foto no debe de pesar más de 3 Megabytes</i>
                                            <br><br>
                                            <input style="margin-left: 35%;" type="file" name="img" id="img">
                                            <br><br>
                                            <input type="hidden" name="id_taller" value="<?php echo $id; ?>">
                                            <?php include_once("./Controlador/agregar_foto_taller.php"); ?>
                                            <a class="btn btn-success" href="./administrar_talleres.php" style="width:60% ;">CANCELAR</a>
                                            <br><br>
                                            <input type="submit" class="btn btn-success" style="width: 60%;" value="AGREGAR FOTO" name="modificar_taller">
                                            <br></br>
                                    </div>
                                </div>
                                <br>
                            </form>
                        <?php
                        }
                        ?>
                        <!------------------------------------------------------------------------------------------->
                    </div>
                    <br>
                    </form>
                </div>
            </div>
            <br><br>
        </div>
<?php
        include_once("./pie.php");
    }
}
?>