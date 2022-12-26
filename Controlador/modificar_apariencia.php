<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("./Modelo/Apariencia/Modificar_apariencia.php");
    $obj_apariencia = new Modificar_apariencia();
    if (isset($_POST["COLORMENU"]) == 'MODIFICAR') {
        if ($obj_apariencia->updateColorMenu($_POST["botonCOLORMENU"], ('COLORMENU')) == 1) {
            //default #72FE10
            //temp #50AC10
            echo '<script type="text/javascript">alert("Color modificado satisfactoriamente");</script>';
        } else {
            echo '<script type="text/javascript">alert("Color no ha sido borrado, reintente en unos minutos");</script>';
        }
?>
        <script>
            document.location.replace("./admon_administrar_apariencia.php");
        </script>
    <?php
    }
    if (isset($_POST["COLORTEXTOMENU"]) == 'MODIFICAR') {
        if ($obj_apariencia->updateColorMenu($_POST["botonCOLORTEXTOMENU"], ('COLORTEXTOMENU')) == 1) {
            //default #72FE10
            //temp #50AC10
            echo '<script type="text/javascript">alert("Color modificado satisfactoriamente");</script>';
        } else {
            echo '<script type="text/javascript">alert("Color no ha sido borrado, reintente en unos minutos");</script>';
        }
    ?>
        <script>
            document.location.replace("./admon_administrar_apariencia.php");
        </script>
    <?php
    }
    if (isset($_POST["COLORFONDOSUPERIOR"]) == 'MODIFICAR') {
        if ($obj_apariencia->updateColorMenu($_POST["botonCOLORFONDOSUPERIOR"], ('COLORFONDOSUPERIOR')) == 1) {
            //default #72FE10
            //temp #50AC10
            echo '<script type="text/javascript">alert("Color modificado satisfactoriamente");</script>';
        } else {
            echo '<script type="text/javascript">alert("Color no ha sido borrado, reintente en unos minutos");</script>';
        }
    ?>
        <script>
            document.location.replace("./admon_administrar_apariencia.php");
        </script>
    <?php
    }
    if (isset($_POST["COLORFONDOINFERIOR"]) == 'MODIFICAR') {
        if ($obj_apariencia->updateColorMenu($_POST["botonCOLORFONDOINFERIOR"], ('COLORFONDOINFERIOR')) == 1) {
            //default #72FE10
            //temp #50AC10
            echo '<script type="text/javascript">alert("Color modificado satisfactoriamente");</script>';
        } else {
            echo '<script type="text/javascript">alert("Color no ha sido borrado, reintente en unos minutos");</script>';
        }
    ?>
        <script>
            document.location.replace("./admon_administrar_apariencia.php");
        </script>
<?php
    }
}
