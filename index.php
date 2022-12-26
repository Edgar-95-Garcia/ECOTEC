<?php
$GLOBALS['menu'] = 'index';
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['t'])) { #para cuando se cierra sesión y se redirige al index con un GET
    if ($_GET['t'] == "0") {
        session_destroy();
?>
        <script>
            window.location.replace("./login.php");
        </script>
<?php
    }
} elseif (isset($_SESSION['admin']) == null && isset($_SESSION['cliente']) == null) { #Se redirigió a index y no hay sesión activa
} else {
    #Por si se redirige al index sin el GET y existe una sesión activa
}

include_once("./cabecera.php");
?>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" style="width: 100%;height:60%">
    <div class="carousel-inner">
        <?php
        include_once("./Controlador/key.php");
        $k = new key();
        include_once("./Modelo/Inicio/Consultar_inicio.php");
        $obj_inicio = new Consultar_inicio();
        $datos_inicio = $obj_inicio->selectInicioPanel($k->enc("."), $k->enc("."));
        $contador = 0;
        foreach ($datos_inicio as $datos_panel) {
        ?>
            <div class="carousel-item <?php echo $contador == 0 ? 'active' : '' ?>">
                <img class="d-block w-100" src="data:image/png;base64,<?php echo $k->dec($datos_panel['IMAGEN']); ?>" style="width:640px;height:360px">
            </div>
        <?php
            $contador++;
        }
        ?>

    </div>
</div>
<br><br>
<div>
    <?php
    include_once("./Controlador/key.php");
    $k = new key();
    include_once("./Modelo/Inicio/Consultar_inicio.php");
    $obj_inicio = new Consultar_inicio();
    $datos_inicio = $obj_inicio->selectInicio();
    $contador = 0;
    foreach ($datos_inicio as $datos) {
        if ($contador % 2 == 0) {
    ?>
            <font size="7" face="Goudy Stout" color="#32D532">
                <img src="data:image/png;base64,<?php echo $k->dec($datos['IMAGEN']); ?>" style="float: left" width="50%">
                <center>
                    <h1><br><?php echo $k->dec($datos['TITULO']) ?></br></h1>
                </center>
            </font>
            <font size="5" face="Britannic Bold" color="#3CA43C">
                <center>
                    <br>
                    <br><?php echo $k->dec($datos['TEXTO']) ?></br>
                    </br>
                </center>
            </font>
            <br>
        <?php
        } else {
        ?>
            <font size="7" face="Goudy Stout" color="#32D532">
                <img src="data:image/png;base64,<?php echo $k->dec($datos['IMAGEN']); ?>" align="right" width="50%">
                <center>
                    <h1><br><?php echo $k->dec($datos['TITULO']) ?></br></h1>
                </center>
            </font>
            <font size="5" face="Britannic Bold" color="#3CA43C">
                <center>
                    <br>
                    <br><?php echo $k->dec($datos['TEXTO']) ?></br>
                    </br>
                </center>
            </font>
            <br>
    <?php
        }
        $contador++;
    }
    ?>

    <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
    <center>
        <div class="fb-post" data-href="https://www.facebook.com/photo?fbid=197991829270050&set=pcb.197991902603376" data-width="500"></div>
        <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
        <div class="fb-post" data-href="https://www.facebook.com/photo?fbid=201601512242415&set=pcb.201601578909075" data-width="500"></div>
    </center>
    </br>
</div>
<?php
include_once("./pie.php");
?>