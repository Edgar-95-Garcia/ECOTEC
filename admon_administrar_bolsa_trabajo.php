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
    include_once("./Modelo/Trabajo/Consultar_trabajo.php");
    $obj_trabajo = new Consultar_trabajo();
    $datos_inicio = $obj_trabajo->selectBolsaTrabajo();
?>
    <div class="card text-center" style="height:100%; position:relative;left:0%">
        <br>
        <div class="card-body">
            <a href="./admon_administrar_bolsa_trabajo_registrar_trabajo.php" class="btn btn-success" style="width: 60%;">Agregar nueva vacante</a>
            <br><br>
            <div class="card">
                <h5 class="card-header">IMAGENES Y ELEMENTOS QUE SE MUESTRAN EN EL PANEL BOLSA DE TRABAJO </h5>
                <div class="card-body">
                    <div style="overflow-x: auto; white-space: nowrap;">
                        <table class="table table-hover" border="2px" style="table-layout:auto; ">
                            <thead>
                                <tr>
                                    <th>IMAGEN</th>
                                    <th>TITULO</th>
                                    <th>DESCRIPCION</th>
                                    <th>VACANTES</th>
                                    <th>FECHA DE PUBLICACIÓN</th>
                                    <th>DISPONIBILIDAD</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($datos_inicio == null) {
                                ?>
                                    <tr>
                                        <th colspan="7"><i>NO HAY TRABAJOS REGISTRADOS</i> </th>
                                    </tr>
                                    <?php
                                } else {
                                    foreach ($datos_inicio as $datos) {
                                    ?>
                                        <tr>
                                            <td>
                                                <img class="imagenes" style="width: 100%;height:100%" src="data:image/png;base64,<?php echo $k->dec($datos['FOTO']); ?>">
                                            </td>
                                            <td>
                                                <?php echo $k->dec($datos['TITULO']); ?>
                                            </td>
                                            <td>
                                                <?php echo $k->dec($datos['DESCRIPCION']); ?>
                                            </td>
                                            <td>
                                                <?php echo ($datos['VACANTES']); ?>
                                            </td>
                                            <td>
                                                <?php echo $k->dec($datos['FECHA_PUBLICACION']); ?>
                                            </td>
                                            <td>
                                                <?php echo ($datos['DISPONIBILIDAD'] == 1) ? 'VACANTE DISPONIBLE' : 'VACANTE NO DISPONIBLE'?>
                                            </td>
                                            <td>
                                            <a class="btn btn-primary" href="./admon_administrar_bolsa_trabajo_modificar_trabajo.php?id=<?php echo ($datos["ID"]) ?>&u=<?php echo $k->enc($_SESSION["admin_ecotec"]) ?>" style="width:210px ;">MODIFICAR</a><br><br>
                                                <a class="btn btn-danger" onClick="return confirm('Confirmar eliminación')" href="./Controlador/eliminar_vacante.php?id=<?php echo ($datos["ID"]) ?>&u=<?php echo $k->enc($_SESSION["admin_ecotec"]) ?>" style="width:210px ;">ELIMINAR</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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

?>