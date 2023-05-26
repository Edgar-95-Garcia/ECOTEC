<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['admin_ecotec'])) {
    $flag = true;
    if (isset($_POST["modificar_super_usuario"]) == "ACTUALIZAR") {

        if (isset($_POST["correo"])) {
            $matricula = htmlentities(strtolower($_POST["correo"]));
        }
        if (isset($_POST["password"])) {
            $contraseña = htmlentities($_POST["password"]);
        }
        $id_super_usuario = htmlentities($_POST["id_super_usuario"]);
        //verificar las variables de los campos que son obligatorios ----------------------------------------

        if (empty($matricula)) {
            echo "<p style='color:red'>*Ingresa matricula</p>";
            $flag = false;
        }
        if (empty($contraseña)) {
            echo "<p style='color:red'>*Ingresa contraseña</p>";
            $flag = false;
        }
        //se verifica que todos los datos hayan sido ingresados correctamente y por lo tanto que la bandera sea TRUE
        if ($flag == true) {
            include_once("./Modelo/Usuarios/Modificar_usuario.php");
            $modificar = new Modificar_usuario();
            $a = $modificar->updateSuperUser($matricula, $contraseña, $id_super_usuario);
            if ($a == 1) {
                echo '<script type="text/javascript">alert("Datos de super usuario modificados");</script>';
?>
                <script>
                    window.location.replace("admon_administrar_superusuario_modificar.php");
                </script>
<?php
            } elseif ($a == 0) {
                echo '<script type="text/javascript">alert("Datos de super usuario no modificados, por favor intente en unos minutos");</script>';
            }
        } else {
            echo '<script type="text/javascript">alert("¡Por favor revisa los datos ingresados!");</script>';
        }
    }
}
