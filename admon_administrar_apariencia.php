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
    include_once("./Modelo/Apariencia/Consultar_apariencia.php");
    $obj_inicio = new Consultar_apariencia();
    $datos_inicio = $obj_inicio->selectApariencia();
?>
    <div class="card text-center" style="height:100%; position:relative;left:0%">
        <div class="card-body">
            <div class="card">
                <h5 class="card-header">ADMINISTRAR COLORES, FUENTES Y OTROS ASPECTOS VISUALES DE LA PÁGINA</h5>
                <div class="card-body">
                    <p>Utiliza la siguiente herramienta para ingresar los colores en formato HEXADECIMAL dependiendo de tu elección</p>
                    <div class="container">
                        <input id="color-picker" type="text" />
                    </div>
                    <script>
                        $(function() {
                            $('#color-picker').colorpicker();
                        });
                    </script>
                    <br>
                    <div style=" overflow-x: auto; white-space: nowrap;">
                        <table class="table table-hover" border="2px" style="table-layout:auto; ">
                            <thead>
                                <tr>
                                    <th>TIPO DE CONFIGURACIÓN</th>
                                    <th>VALOR</th>
                                    <th>OPERACION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                    <?php include_once("./Controlador/modificar_apariencia.php"); ?>
                                    <?php
                                    foreach ($datos_inicio as $datos) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $k->dec($datos['TIPO']); ?>
                                            </td>
                                            <td>
                                                <p><?php //echo $k->dec($datos['TIPO']); ?></p>
                                                <input type="text" name="<?php echo "boton".$k->dec($datos['TIPO']); ?>" value="<?php echo $k->dec($datos['VALOR']); ?>">
                                            </td>
                                            <td>
                                                <input class="btn btn-primary" onClick="return confirm('Confirmar modificación')" type="submit" value="MODIFICAR" name="<?php echo $k->dec($datos['TIPO']); ?>">
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </form>
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