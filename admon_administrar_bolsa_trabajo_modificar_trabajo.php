<?php
$GLOBALS['menu'] = 'prson';
include_once("./cabecera.php");
include_once("./Controlador/key.php");
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["admin_ecotec"]) == null) {
    ?>
    <script>
        window.location.replace("index.php");
    </script>
    <?php
} else if (isset($_SESSION["admin_ecotec"]) == "ecotec" && isset($_GET["id"]) && isset($_GET["u"])) {
    $k = new key();
    $id_vacante = $_GET['id'];
    $u = $k->dec($_GET['u']);
    include_once("./Modelo/Trabajo/Consultar_trabajo.php");
    $obj_trabajo = new Consultar_trabajo();
    $datos_trabajo = $obj_trabajo->selectBolsaTrabajoById($id_vacante);
    foreach ($datos_trabajo as $vacante) {
        ?>
            <div class="card text-center" style="width:50%;height:100%; position:relative;left:25%">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="card">
                            <font size="6" face="Cooper Black" color="#3CA43C">
                                <h5 class="card-header">Formulario para modificar el anuncio con titulo <?php echo $k->dec($vacante['TITULO']) ?>
                                </h5>
                            </font>
                            <div class="card-body">
                                <font size="4" face="Constantia" color="#3CA43C">
                                    <p class="card-text">
                                    <div class="form-group">
                                        <input type="hidden" name="id_vacante" id="id_vacante" value="<?php echo $vacante['ID'] ?>">
                                        <label for="titulo">Ingresa un titulo para el anuncio</label><br>
                                        <input type="text" id="titulo" name="titulo" value="<?php echo $k->dec($vacante['TITULO']) ?>"><br><br>
                                        <label for="descripcion">Ingresa una descripción para el anuncio</label><br>
                                        <textarea name="descripcion" id="descripcion" cols="50" rows="3"><?php echo $k->dec($vacante['DESCRIPCION']) ?></textarea><br>
                                        
                                        <label for="disponibilidad">Modifica la disponibilidad del anuncio</label><br>
                                        <select name="disponibilidad" id="disponibilidad">
                                            <option value="1" <?php echo ($vacante['DISPONIBILIDAD'] == 1) ? 'selected' : '' ?>>Disponible</option>
                                            <option value="0" <?php echo ($vacante['DISPONIBILIDAD'] == 0) ? 'selected' : '' ?>>No disponible</option>
                                        </select><br><br>
                                        <label for="vacantes">La foto ingresada se muestra a continuación</label><br>
                                        <img class="imagenes" style="width: 100%;height:100%" src="data:image/png;base64,<?php echo $k->dec($vacante['FOTO']); ?>"><br><br>
                                        <label for="FILE">Para modificar la imágen debes agregar una imágen/foto nueva <br><i>(La foto no debe de pesar más de 3 Megabytes)</i><br></label>
                                        <input type="file" class="form-control-file" id="FILE" name="img">
                                    </div>
                                <?php include("./Controlador/modificar_bolsa_trabajo.php"); ?>
                                    <input type="submit" class="btn btn-primary" style="width: 60%;" value="MODIFICAR" name="modificar_panel_noticia">
                                    <br></br>
                                    <a href="./admon_administrar_bolsa_trabajo.php"> <input class="btn btn-success" style="width: 60%;" type="button" value="REGRESAR"></a>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        <?php
    }
    include_once("./pie.php");
} else {
    ?>
        <script>
            window.location.replace("index.php");
        </script>
    <?php
}

?>