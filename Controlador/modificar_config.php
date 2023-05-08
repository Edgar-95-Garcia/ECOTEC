<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['admin_ecotec'])) {
    $flag = true;
    if (isset($_POST["modificar_pass"]) == "ACTUALIZAR") {
        if (isset($_POST["pass"])) {
            $pass = htmlentities($_POST["pass"]);
        } else {
            echo "<p style='color:red'>*Ingresa contraseña de registro</p>";
            $flag = false;
        }
        //------------------------------------------
        if ($flag == true) {
            include_once("./Modelo/Config/Modificar_config.php");
            $modificar = new Modificar_config();
            $a = $modificar->updatePass($pass);
            if ($a == 1) {
                echo '<script type="text/javascript">alert("Contraseña actualizada");</script>';
            ?>
                <script>
                    window.location.replace("admon_administrar_superusuario_modificar.php");
                </script>
<?php
            } elseif ($a == 0) {
                echo '<script type="text/javascript">alert("Contraseña no actualizada, por favor intente en unos minutos");</script>';
            }
        } else {
            echo '<script type="text/javascript">alert("¡Por favor revisa los datos ingresados!");</script>';
        }
    }
}
