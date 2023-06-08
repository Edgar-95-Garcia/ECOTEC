<?php 
$GLOBALS['menu'] = 'RIDE';
include_once("./cabecera.php");
?>
<?php 
include_once("./Controlador/key.php");
$k = new key();
include_once("./Modelo/TablaEcoride/Consultar_tabla_inicio_ecoride.php");
$obj_tabla = new Consultar_tabla_inicio_ecoride();
$datos_tabla = $obj_tabla->selectTablaInicio();
$auxiliar = 0;
?>
<div style="width:80%; position: relative; left:10%">
    <table class="table table-bordered table-hover">
        <tbody>
            
                <?php 
                foreach($datos_tabla as $tabla){
                    if($auxiliar % 2 == 0){
                        ?>
                        <tr>
                            <td style="text-align: end; font-size:30px; font-family: 'Goudy Stout'">
                                <?php echo $k->dec($tabla['TITULO'])?>
                                <br>
                                <img class="card-table-top" src="data:image/png;base64,<?php echo $k->dec($tabla['IMAGEN']); ?>">
                            </td>
                            <td class="align-middle" style="text-align: start;"><?php echo $k->dec($tabla['TEXTO'])?></td>
                        </tr>
                        <?php
                    }else{
                        ?>
                        <tr>
                            <td class="align-middle" style="text-align: end;"><?php echo $k->dec($tabla['TEXTO'])?></td> 
                            <td style="text-align: start; font-size:30px; font-family: 'Goudy Stout'">
                                <?php echo $k->dec($tabla['TITULO'])?>
                                <br>
                                <img class="card-table-top" src="data:image/png;base64,<?php echo $k->dec($tabla['IMAGEN']); ?>">
                            </td>
                            
                        </tr>
                        <?php
                    }
                    $auxiliar++;
                }
                ?>
            
        </tbody>
    </table>
</div>
<hr>
<?php
include_once("./pie.php");
?>