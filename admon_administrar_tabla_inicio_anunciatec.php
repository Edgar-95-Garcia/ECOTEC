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
    include_once("./Modelo/TablaAnunciaTec/Consultar_tabla_inicio_anunciatec.php");
    $obj_inicio = new Consultar_tabla_inicio_anunciatec();
    $datos_inicio = $obj_inicio->selectTablaInicio();
?>
    <div class="card text-center" style="height:100%; position:relative;left:0%">
        <br>
        <div class="card-body">
            <a href="./admon_administrar_tabla_inicio_anunciatec_registrar.php" class="btn btn-success" style="width: 60%;">Crear nuevo dato para la tabla de AnunciaTec</a>
            <br><br>
            <div class="card">
                <h5 class="card-header">INFORMACIÓN REGISTRADA</h5>
                <div class="card-body">
                    <div style="overflow-x: auto; white-space: nowrap;">
                        <table class="table table-hover" border="2px" style="table-layout:auto; ">
                            <thead>
                                <tr>
                                    <th>IMAGEN</th>
                                    <th>TITULO</th>
                                    <th>TEXTO</th>
                                    <th>OPERACION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($datos_inicio == null) {
                                ?>
                                    <tr>
                                        <th colspan="4"><i>NO HAY INFORMACIÓN REGISTRADA</i> </th>
                                    </tr>
                                    <?php
                                } else {


                                    foreach ($datos_inicio as $datos) {
                                    ?>
                                        <tr>
                                            <td>
                                                <img class="imagenes" style="width: 100%;height:100%" src="data:image/png;base64,<?php echo $k->dec($datos['IMAGEN']); ?>">
                                            </td>
                                            <td>
                                                <?php echo $k->dec($datos['TITULO']); ?>
                                            </td>
                                            <td style="white-space: normal;">
                                                <?php echo $k->dec($datos['TEXTO']); ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger" onClick="return confirm('Confirmar eliminación')" href="./Controlador/eliminar_tabla_anunciatec.php?id=<?php echo ($datos["ID"]) ?>&u=<?php echo $k->enc($_SESSION["admin_ecotec"]) ?>" style="width:210px ;">ELIMINAR</a>
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