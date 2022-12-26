<?php
$GLOBALS['menu'] = 'administrar_talleres';
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["admin"]) == null) { //se verifica que exista sesion en el servidor
?>
    <script>
        window.location.replace("index.php");
    </script>
    <?php
} else if (isset($_GET['id']) && isset($_GET['u']) && isset($_GET['p'])) {
    //se verifica que la ruta ingresada sea igual al de la sesion generada
    include_once("./Controlador/key.php");
    $k = new key();
    $auxiliar_boton_generar = false;
    if ($_SESSION["user"] == $_GET['u']) {
        include_once("./cabecera.php");
        $id_taller = $_GET['id'];
        include_once("./Modelo/Talleres/Consultar_taller.php");
        $obj_talleres = new Consultar_taller();
        $datos = $obj_talleres->selectTallerFromIdTaller($id_taller);
        foreach ($datos as $nombre_taller) {
            $nombre = $k->dec($nombre_taller['NOMBRE']);
        }
        include_once("./Modelo/Asistencia/Consultar_asistencia.php");
        $obj_asistencia = new Consultar_asistencia();
        $datos_asistencia = $obj_asistencia->selectAsistenciaFromIdTaller($id_taller);
    ?>
        <div class="card text-center" style="height:100%; position:relative;left:0%">
            <br>
            <div class="card-body">
                <div class="card">
                    <P class="card-header" style="color:#0860DF; font-size:large;font-family:Bodoni MT Black">GENERAR REPORTE DE ASISTENCIA DEL DÍA PARA EL TALLER CON NOMBRE <br><?php echo $nombre ?></P>
                    <div class="card-body">
                        <!------------------------------------------------------------------------------------------->
                        <div style="overflow-x: auto; white-space: nowrap;">
                            <form action="./Controlador/generar_reporte_asistencias.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="taller" value="<?php echo $nombre ?>">
                                <input type="hidden" name="id_taller" value="<?php echo $id_taller ?>">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">SELECCIONA PERIODO A GENERAR</label>
                                    </div>
                                    <select class="custom-select" name="PERIODO">
                                        <?php
                                        if ($datos_asistencia == null) {
                                        ?>
                                            <option value="NA">No existen periodos para generar reporte</option>
                                            <?php
                                        } else {
                                            $auxiliar_boton_generar = true;
                                            foreach ($datos_asistencia as $periodo) {
                                            ?>
                                                <option value="<?php echo ($periodo['PERIODO']); ?>"><?php echo $k->dec($periodo['PERIODO']); ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php
                                if ($auxiliar_boton_generar == true) {
                                ?>
                                    <input class="btn btn-primary" style="width:50%" type="submit" value="GENERAR REPORTE" name="generar_reporte">
                                <?php
                                }
                                ?>
                            </form>
                        </div>
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
    } else {
    ?>
        <script>
            window.location.replace("index.php");
        </script>
    <?php
    }
} else {
    ?>
    <script>
        window.location.replace("index.php");
    </script>
<?php
}
?>