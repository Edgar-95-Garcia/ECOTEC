<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flag = true;
    if ($_POST["modificar_taller"] == "ACTUALIZAR") {
        if (isset($_POST["nombre_taller"])) {
            $nombre_taller = htmlentities($_POST["nombre_taller"]);
        }
        if (isset($_POST["lunes"])) {
            $lunes = htmlentities($_POST["lunes"]);
        }
        if (isset($_POST["martes"])) {
            $martes = htmlentities($_POST["martes"]);
        }
        if (isset($_POST["miercoles"])) {
            $miercoles = htmlentities($_POST["miercoles"]);
        }
        if (isset($_POST["jueves"])) {
            $jueves = htmlentities($_POST["jueves"]);
        }
        if (isset($_POST["viernes"])) {
            $viernes = htmlentities($_POST["viernes"]);
        }
        if (isset($_POST["sabado"])) {
            $sabado = htmlentities($_POST["sabado"]);
        }
        if (isset($_POST["domingo"])) {
            $domingo = htmlentities($_POST["domingo"]);
        }
        if (isset($_POST["clave"])) {
            $clave = htmlentities($_POST["clave"]);
        }
        if (isset($_POST["descripcion"])) {
            $descripcion = htmlentities($_POST["descripcion"]);
        }
        if (isset($_POST["salon"])) {
            $salon = htmlentities($_POST["salon"]);
        }
        if (isset($_POST["cupo"])) {
            $cupo = htmlentities($_POST["cupo"]);
        }
        if (isset($_POST["departamento"])) {
            $departamento = htmlentities($_POST["departamento"]);
        }
        if (isset($_POST["status"])) {
            $status = htmlentities($_POST["status"]);
        }
        $id_taller = $_POST["id_taller"];
        $id_profesor = $_POST['profesor'];
        //verificar las variables de los campos que son obligatorios ----------------------------------------
        if (empty($nombre_taller)) {
            echo "<p style='color:red'>*Ingresa el nombre del taller</p>";
            $flag = false;
        }
        if (empty($descripcion)) {
            echo "<p style='color:red'>*Ingresa descripción</p>";
            $flag = false;
        }
        if (empty($cupo)) {
            echo "<p style='color:red'>*Ingresa cupo</p>";
            $flag = false;
        }
        if (empty($departamento)) {
            echo "<p style='color:red'>*Ingresa departamento</p>";
            $flag = false;
        }
        if (empty($status)) {
            echo "<p style='color:red'>*Ingresa estatus, Activo o Inactivo</p>";
            $flag = false;
        }

        //se verifica que todos los datos hayan sido ingresados correctamente y por lo tanto que la bandera sea TRUE
        if ($flag == true) {
            include_once("./Modelo/Talleres/Modificar_taller.php");
            $modificar = new Modificar_taller();
            $a = $modificar->updateTaller($id_profesor,$nombre_taller, $lunes, $martes, $miercoles, $jueves, $viernes, $sabado, $domingo, $clave, $descripcion, $salon, $cupo, $departamento, $status, $id_taller);
            if ($a == 1) {
                echo '<script type="text/javascript">alert("Taller modificado");</script>';
                if (isset($_SESSION["admin_ecotec"]) == "ecotec") {
?>
                    <script>
                        window.location.replace("admon_administrar_talleres.php");
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        window.location.replace("administrar_talleres.php");
                    </script>
<?php
                }
            } elseif ($a == 0) {
                echo '<script type="text/javascript">alert("Taller no modificado, por favor intente en unos minutos");</script>';
            }
        } else {
            echo '<script type="text/javascript">alert("¡Por favor revisa los datos ingresados!");</script>';
        }
    }
}
