<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flag = true;
    $temp = 2; //bandera que permite llevar un control de validaciones del formulario (se verifica que no existan campos vacios)
    if ($_POST["aceptar"] == "Ingresar") {
        if (isset($_POST["c_u"])) {
            $correo = htmlentities(strtolower($_POST["c_u"]));
        }
        if (isset($_POST["con"])) {
            $pass = htmlentities($_POST["con"]);
        }
    }
    if (empty($correo)) {
        echo "<p style='color:red'>*Ingresa tu correo</p>";
        $flag = false;
    } else {
        $temp--;
    }
    if (empty($pass)) {
        echo "<p style='color:red'>*Ingresa tu contraseña</p><br>";
        $flag = false;
    } else {
        $temp--;
    }
    if ($flag == true && $temp == 0) {
        include_once("./Modelo/conect.php");
        $mysql_object = new conect();
        include_once("./Modelo/Usuarios/Consultar_usuario.php");
        $consultar = new Consultar_usuario();
        $val =  intval(($consultar->selectUserUserName($correo, $pass)));
        if ($val == 4) {
            //cuenta no está activada
            echo "<p style='color:red'>*Activa tu cuenta, revisa tu correo electrónico</p><br>";
        } else if ($val == 3) {
            //ingresa usuario ADMINISTRADOR de sitio
            $actual_session = md5($correo);
            $_SESSION["user_ecotec"] = $actual_session;
            $_SESSION["nombre_ecotec"] = $consultar->selectNameUserName($correo);
            $_SESSION["admin_ecotec"] = "ecotec";
?>
            <script>
                window.location.replace("./index.php");
            </script>
        <?php
        } else if ($val == 2) {
            //reservado para otro tipo de usuarios no determinados
            #include_once("");
        } else if ($val == 1) {
            //ingresa usuario NORMAL (alumno)
            $actual_session = md5($correo);
            $_SESSION["user"] = $actual_session;
            $_SESSION["nombre"] = $consultar->selectNameUserName($correo);
            $_SESSION["id"] = $consultar->selectUserIDFromCorreo($correo);
        ?>
            <script>
                window.location.replace("./index.php");
            </script>
        <?php
        } else if ($val == 0) {
            //ingresa usuario PROFESOR
            $actual_session = md5($correo);
            $_SESSION["user"] = $actual_session;
            $_SESSION["nombre"] = $consultar->selectNameUserName($correo);
            $_SESSION["admin"] = "admin";
            $_SESSION["id"] = $consultar->selectUserIDFromCorreo($correo);
        ?>
            <script>
                window.location.replace("./administrar_talleres.php");
            </script>
<?php
        } else if ($val == 5) {
            //usuario no existe o credenciales son incorrectas
            echo "<p style='color:red'>*El correo o contraseña son incorrectos</p><br>";
        }
    }
}
