<?php 
$GLOBALS['menu'] = 'BOLSA DE TRABAJO';
include_once("./cabecera.php");
?>
<?php
    include_once("./Controlador/key.php");
    $k = new key();
    include_once("./Modelo/Trabajo/Consultar_trabajo.php");
    $obj_vacante = new Consultar_trabajo();
    $datos_inicio = $obj_vacante->selectBolsaTrabajo();
    $contador = 0;
    foreach ($datos_inicio as $datos) {
        if ($contador % 2 == 0) {
    ?>
            <font size="7" face="Goudy Stout" color="#32D532">
                <img src="data:image/png;base64,<?php echo $k->dec($datos['FOTO']); ?>" style="float: left" width="50%">
                <center>
                    <h1><br><?php echo $k->dec($datos['TITULO']) ?></br></h1>
                </center>
            </font>
            <font size="5" face="Britannic Bold" color="#3CA43C">
                <center>
                    <br>
                    <br><?php echo $k->dec($datos['DESCRIPCION']) ?></br>
                    <br><?php echo ($datos['VACANTES']) ?></br>
                    <br><?php echo $k->dec($datos['FECHA_PUBLICACION']) ?></br>
                    <br><?php echo ($datos['DISPONIBILIDAD'] == 1) ? 'Vacante disponible':'Vacante ya no está disponible' ?></br>
                </br>
            </center>
        </font>
        <br>
        <?php
        } else {
        ?>
            <font size="7" face="Goudy Stout" color="#32D532">
                <img src="data:image/png;base64,<?php echo $k->dec($datos['FOTO']); ?>" align="right" width="50%">
                <center>
                    <h1><br><?php echo $k->dec($datos['TITULO']) ?></br></h1>
                </center>
            </font>
            <font size="5" face="Britannic Bold" color="#3CA43C">
                <center>
                <br>
                    <br><?php echo $k->dec($datos['DESCRIPCION']) ?></br>
                    <br><?php echo ($datos['VACANTES']) ?></br>
                    <br><?php echo $k->dec($datos['FECHA_PUBLICACION']) ?></br>
                    <br><?php echo ($datos['DISPONIBILIDAD'] == 1) ? 'Vacante disponible':'Vacante ya no está disponible' ?></br>
                    </br>
                </center>
            </font>
            <br>
    <?php
        }
        $contador++;
    }
    ?>

<?php
include_once("./pie.php");
?>