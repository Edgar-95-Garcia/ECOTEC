<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['admin_ecotec'])) {
    $flag = true;
    if ($_POST["modificar_alumno"] == "ACTUALIZAR") {
        if (isset($_POST["nombres"])) {
            $nombres = htmlentities($_POST["nombres"]);
        }
        if (isset($_POST["paterno"])) {
            $apellido_paterno = htmlentities($_POST["paterno"]);
        }
        if (isset($_POST["materno"])) {
            $apellido_materno = htmlentities($_POST["materno"]);
        }
        if (isset($_POST["matricula"])) {
            $matricula = htmlentities($_POST["matricula"]);
        }
        if (isset($_POST["telcontact"])) {
            $telcontact = htmlentities($_POST["telcontact"]);
        }
        if (isset($_POST["correo"])) {
            $correo = htmlentities(strtolower($_POST["correo"]));
        }
        if (isset($_POST["password"])) {
            $contraseña = htmlentities($_POST["password"]);
        }
        if (isset($_POST["status"])) {
            $status = htmlentities($_POST["status"]);
        }
        if (isset($_POST["level"])) {
            $level = htmlentities($_POST["level"]);
        }
        $id_profesor = htmlentities($_POST["id_alumno"]);
        //verificar las variables de los campos que son obligatorios ----------------------------------------
        if (empty($nombres)) {
            echo "<p style='color:red'>*Ingresa nombre o nombres</p>";
            $flag = false;
        }
        if (empty($apellido_paterno)) {
            echo "<p style='color:red'>*Ingresa apellido paterno</p>";
            $flag = false;
        }
        if (empty($apellido_materno)) {
            echo "<p style='color:red'>*Ingresa apellido materno</p>";
            $flag = false;
        }
        if (empty($matricula)) {
            echo "<p style='color:red'>*Ingresa matricula</p>";
            $flag = false;
        }
        if (empty($telcontact)) {
            echo "<p style='color:red'>*Ingresa teléfono de contacto</p>";
            $flag = false;
        }
        if (empty($correo)) {
            echo "<p style='color:red'>*Ingresa correo</p>";
            $flag = false;
        }
        if (empty($contraseña)) {
            echo "<p style='color:red'>*Ingresa contraseña</p>";
            $flag = false;
        }
        if (!isset(($status))) {
            echo "<p style='color:red'>*Ingresa estatus</p>";
            $flag = false;
        }
        if (!isset(($level))) {
            echo "<p style='color:red'>*Ingresa nivel de usuario</p>";
            $flag = false;
        }
        //se verifica que todos los datos hayan sido ingresados correctamente y por lo tanto que la bandera sea TRUE
        if ($flag == true) {
            include_once("./Modelo/Usuarios/Modificar_usuario.php");
            $modificar = new Modificar_usuario();
            $a = $modificar->updateAlumno($nombres,$apellido_paterno,$apellido_materno,$matricula,$telcontact,$correo,$contraseña,$status,$level,$id_profesor);
            if ($a == 1) {
                echo '<script type="text/javascript">alert("Datos de alumno modificados");</script>';
?>
                <script>
                    window.location.replace("admon_administrar_alumnos.php");
                </script>
<?php
            } elseif ($a == 0) {
                echo '<script type="text/javascript">alert("Datos de alumno no modificados, por favor intente en unos minutos");</script>';
            }
        } else {
            echo '<script type="text/javascript">alert("¡Por favor revisa los datos ingresados!");</script>';
        }
    }
}
